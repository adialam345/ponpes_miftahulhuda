<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect to activities management instead
        return redirect()->route('admin.activities.index')
                         ->with('info', 'Galeri foto kini dikelola melalui halaman kegiatan.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to activities management instead
        return redirect()->route('admin.activities.index')
                         ->with('info', 'Galeri foto kini dikelola melalui halaman kegiatan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // If we somehow reach here, require an activity_id
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'gallery-' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $path;
        }
        
        // Set default order if not provided
        if (empty($data['order'])) {
            $lastOrder = Gallery::max('order');
            $data['order'] = $lastOrder ? $lastOrder + 1 : 1;
        }
        
        Gallery::create($data);
        
        return redirect()->route('admin.activities.show', $data['activity_id'])
                         ->with('success', 'Foto berhasil ditambahkan ke galeri kegiatan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::with('activity')->findOrFail($id);
        
        // If gallery doesn't have an activity, redirect to activities index
        if (!$gallery->activity_id) {
            return redirect()->route('admin.activities.index')
                         ->with('info', 'Galeri foto kini dikelola melalui halaman kegiatan.');
        }
        
        return redirect()->route('admin.activities.show', $gallery->activity_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // If gallery doesn't have an activity, redirect to activities index
        if (!$gallery->activity_id) {
            return redirect()->route('admin.activities.index')
                         ->with('info', 'Galeri foto kini dikelola melalui halaman kegiatan.');
        }
        
        return redirect()->route('admin.activities.show', $gallery->activity_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $gallery = Gallery::findOrFail($id);
        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            
            $image = $request->file('image');
            $imageName = 'gallery-' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $path;
        }
        
        $gallery->update($data);
        
        return redirect()->route('admin.activities.show', $data['activity_id'])
                         ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        $activityId = $gallery->activity_id;
        
        // If gallery doesn't have an activity, redirect to activities index
        if (!$activityId) {
            // Delete the image if it exists
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            
            $gallery->delete();
            
            return redirect()->route('admin.activities.index')
                         ->with('info', 'Galeri foto kini dikelola melalui halaman kegiatan.');
        }
        
        // Delete the image if it exists
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();
        
        return redirect()->route('admin.activities.show', $activityId)
                         ->with('success', 'Foto berhasil dihapus dari galeri kegiatan.');
    }
    
    /**
     * Update the order of gallery items.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:galleries,id',
            'items.*.order' => 'required|integer',
        ]);
        
        foreach ($request->items as $item) {
            Gallery::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Upload multiple images to an activity gallery
     */
    public function uploadMultiple(Request $request, $activityId)
    {
        // Validasi jumlah file dan ukuran total
        if ($request->hasFile('images')) {
            $totalSize = 0;
            foreach ($request->file('images') as $image) {
                $totalSize += $image->getSize();
            }
            
            // Konversi 40MB ke bytes (40 * 1024 * 1024)
            if ($totalSize > 41943040) {
                return redirect()->back()->withErrors([
                    'images' => 'Total ukuran semua foto tidak boleh melebihi 40MB'
                ]);
            }
            
            // Batasi maksimal 20 foto sekaligus
            if (count($request->file('images')) > 20) {
                return redirect()->back()->withErrors([
                    'images' => 'Maksimal 20 foto yang dapat diunggah sekaligus'
                ]);
            }
        }

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'title' => 'nullable|string|max:255',
        ]);
        
        $activity = Activity::findOrFail($activityId);
        $lastOrder = Gallery::where('activity_id', $activityId)->max('order');
        $order = $lastOrder ? $lastOrder + 1 : 1;
        
        $title = $request->title ?? $activity->title;
        
        foreach ($request->file('images') as $image) {
            $imageName = 'gallery-' . time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('gallery', $imageName, 'public');
            
            Gallery::create([
                'activity_id' => $activityId,
                'title' => $title,
                'description' => $activity->description,
                'image' => $path,
                'alt_text' => $title,
                'is_active' => true,
                'order' => $order++,
            ]);
        }
        
        return redirect()->route('admin.activities.show', $activityId)
                         ->with('success', 'Semua foto berhasil diupload ke galeri kegiatan.');
    }

    /**
     * Handle chunked file upload
     */
    public function handleChunkUpload(Request $request, $activityId)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('file');
        $resumableIdentifier = $request->input('resumableIdentifier');
        $resumableChunkNumber = $request->input('resumableChunkNumber');
        $resumableTotalChunks = $request->input('resumableTotalChunks');
        $resumableFilename = $request->input('resumableFilename');

        // Buat direktori temporary untuk menyimpan chunks
        $tempDirectory = storage_path('app/chunks/' . $resumableIdentifier);
        if (!file_exists($tempDirectory)) {
            mkdir($tempDirectory, 0777, true);
        }

        // Simpan chunk
        $chunkFile = $tempDirectory . '/' . $resumableChunkNumber;
        $file->move($tempDirectory, $resumableChunkNumber);

        // Cek apakah semua chunk sudah terupload
        $uploadedChunks = count(glob($tempDirectory . '/*'));
        if ($uploadedChunks == $resumableTotalChunks) {
            // Gabungkan semua chunk
            $finalPath = storage_path('app/public/gallery/gallery-' . time() . '-' . rand(1000, 9999) . '-' . $resumableFilename);
            $this->combineChunks($tempDirectory, $finalPath, $resumableTotalChunks);

            // Hapus direktori temporary
            $this->cleanupChunks($tempDirectory);

            // Simpan ke database
            $relativePath = 'gallery/gallery-' . time() . '-' . rand(1000, 9999) . '-' . $resumableFilename;
            $activity = Activity::findOrFail($activityId);
            $lastOrder = Gallery::where('activity_id', $activityId)->max('order');
            $order = $lastOrder ? $lastOrder + 1 : 1;

            Gallery::create([
                'activity_id' => $activityId,
                'title' => $activity->title,
                'description' => $activity->description,
                'image' => $relativePath,
                'alt_text' => $activity->title,
                'is_active' => true,
                'order' => $order,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => true, 'chunksUploaded' => $uploadedChunks]);
    }

    /**
     * Combine all chunks into final file
     */
    private function combineChunks($chunksDirectory, $finalPath, $totalChunks)
    {
        $out = fopen($finalPath, 'wb');

        for ($i = 1; $i <= $totalChunks; $i++) {
            $chunkFile = $chunksDirectory . '/' . $i;
            $in = fopen($chunkFile, 'rb');
            stream_copy_to_stream($in, $out);
            fclose($in);
        }

        fclose($out);
    }

    /**
     * Clean up chunks directory
     */
    private function cleanupChunks($directory)
    {
        $files = glob($directory . '/*');
        foreach ($files as $file) {
            unlink($file);
        }
        rmdir($directory);
    }
}
