<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Registration;
use App\Models\Activity;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate total news and this month's increase
        $totalNews = News::count();
        $newsThisMonth = News::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Calculate total registrations and this week's increase
        $totalRegistrations = Registration::count();
        $registrationsThisWeek = Registration::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        // Calculate total activity photos and today's increase
        $totalActivityPhotos = Activity::join('galleries', 'activities.id', '=', 'galleries.activity_id')
            ->where('galleries.is_active', true)
            ->count();
        $activityPhotosToday = Activity::join('galleries', 'activities.id', '=', 'galleries.activity_id')
            ->where('galleries.is_active', true)
            ->whereDate('galleries.created_at', Carbon::today())
            ->count();

        // Get recent activities for the live feed
        $recentActivities = Activity::with('galleries')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalNews',
            'newsThisMonth',
            'totalRegistrations',
            'registrationsThisWeek',
            'totalActivityPhotos',
            'activityPhotosToday',
            'recentActivities'
        ));
    }
}
