<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $data = $request->only(['title', 'content', 'status']);
        
        if ($request->status == 'published') {
            $data['published_at'] = Carbon::now();
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $news = News::findOrFail($id);
        $data = $request->only(['title', 'content', 'status']);
        
        // Set published_at if status changes to published
        if ($request->status == 'published' && ($news->status != 'published' || !$news->published_at)) {
            $data['published_at'] = Carbon::now();
        }

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        
        // Delete the image if it exists
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        
        $news->delete();
        
        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
