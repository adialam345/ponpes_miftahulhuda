<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index()
    {
        $news = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);
            
        return view('news.index', compact('news'));
    }

    /**
     * Display the specified news article.
     */
    public function show($id)
    {
        $news = News::where('status', 'published')
            ->findOrFail($id);
            
        return view('news.show', compact('news'));
    }
}
