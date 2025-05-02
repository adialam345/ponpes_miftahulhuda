<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Activity;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index()
    {
        // Get active activities with photos (just one photo per activity for thumbnail)
        $activities = Activity::active()
            ->ordered()
            ->whereHas('galleries', function($query) {
                $query->active();
            })
            ->with(['thumbnailGallery', 'galleries' => function($query) {
                $query->active()->ordered();
            }])
            ->withCount(['galleries' => function($query) {
                $query->active();
            }])
            ->get();
        
        return view('gallery', compact('activities'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activity = Activity::active()
            ->with(['galleries' => function($query) {
                $query->active()->ordered();
            }])
            ->findOrFail($id);
        
        return view('gallery-detail', compact('activity'));
    }
} 