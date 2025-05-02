<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with(['thumbnailGallery', 'galleries' => function($query) {
            $query->active();
        }])
        ->withCount(['galleries' => function($query) {
            $query->active();
        }])
        ->orderBy('order', 'asc')
        ->get();
        
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_date' => 'nullable|date',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->except('images');
        
        // Generate a slug from the title
        $data['slug'] = Str::slug($request->title);
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = 'gallery-' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('gallery', $thumbnailName, 'public');
            
            // Create activity first
            $activity = Activity::create($data);
            
            // Create gallery entry for thumbnail
            Gallery::create([
                'activity_id' => $activity->id,
                'title' => $activity->title,
                'description' => $activity->description,
                'image' => $thumbnailPath,
                'alt_text' => $activity->alt_text ?? $activity->title,
                'is_active' => true,
                'is_thumbnail' => true,
                'order' => 1
            ]);
            
            // Handle multiple image uploads if provided
            if ($request->hasFile('images')) {
                $this->saveGalleryImages($request->file('images'), $activity);
            }
            
            return redirect()->route('admin.activities.index')
                            ->with('success', 'Kegiatan berhasil ditambahkan.');
        }
        
        return redirect()->back()
                        ->withInput()
                        ->withErrors(['thumbnail' => 'Thumbnail wajib diupload.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activity::with(['galleries' => function($query) {
            $query->orderBy('order', 'asc');
        }])->findOrFail($id);
        
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activity = Activity::findOrFail($id);
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_date' => 'nullable|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $activity = Activity::findOrFail($id);
        $data = $request->except(['images', '_token', '_method']);
        
        // Update slug if title has changed
        if ($request->title != $activity->title) {
            $data['slug'] = Str::slug($request->title);
        }
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = 'gallery-' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = $thumbnail->storeAs('gallery', $thumbnailName, 'public');
            
            // Reset all thumbnails for this activity
            Gallery::where('activity_id', $activity->id)
                  ->update(['is_thumbnail' => false]);
            
            // Create new gallery entry for thumbnail
            Gallery::create([
                'activity_id' => $activity->id,
                'title' => $activity->title,
                'description' => $activity->description,
                'image' => $thumbnailPath,
                'alt_text' => $activity->alt_text ?? $activity->title,
                'is_active' => true,
                'is_thumbnail' => true,
                'order' => 1
            ]);
        }
        
        $activity->update($data);
        
        // Handle multiple image uploads if provided
        if ($request->hasFile('images')) {
            $this->saveGalleryImages($request->file('images'), $activity);
        }
        
        return redirect()->route('admin.activities.index')
                         ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        
        // Delete thumbnail if exists
        if ($activity->thumbnail && Storage::disk('public')->exists($activity->thumbnail)) {
            Storage::disk('public')->delete($activity->thumbnail);
        }
        
        // Delete all associated gallery images
        foreach ($activity->galleries as $gallery) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $gallery->delete();
        }
        
        $activity->delete();
        
        return redirect()->route('admin.activities.index')
                         ->with('success', 'Kegiatan berhasil dihapus.');
    }
    
    /**
     * Update the order of activities.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:activities,id',
            'items.*.order' => 'required|integer',
        ]);
        
        foreach ($request->items as $item) {
            Activity::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Save multiple gallery images for an activity
     */
    private function saveGalleryImages($images, $activity)
    {
        $lastOrder = Gallery::where('activity_id', $activity->id)->max('order');
        $order = $lastOrder ? $lastOrder + 1 : 1;
        
        foreach ($images as $image) {
            $imageName = 'gallery-' . time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('gallery', $imageName, 'public');
            
            Gallery::create([
                'activity_id' => $activity->id,
                'title' => $activity->title,
                'description' => $activity->description,
                'image' => $path,
                'alt_text' => $activity->alt_text ?? $activity->title,
                'is_active' => true,
                'is_thumbnail' => false,
                'order' => $order++,
            ]);
        }
    }
}
