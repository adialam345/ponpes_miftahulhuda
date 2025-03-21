<?php

namespace App\Http\Controllers;

use App\Models\RegistrationPage;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of available registration pages
     */
    public function index()
    {
        $pondokPage = RegistrationPage::where('page_type', 'pondok')->latest()->first();
        $smpPage = RegistrationPage::where('page_type', 'smp')->latest()->first();
        
        return view('registration.index', compact('pondokPage', 'smpPage'));
    }
    
    /**
     * Display the specified registration page
     */
    public function show($type)
    {
        if (!in_array($type, ['pondok', 'smp'])) {
            abort(404);
        }
        
        $registrationPage = RegistrationPage::where('page_type', $type)->latest()->first();
        
        if (!$registrationPage) {
            abort(404, 'Halaman pendaftaran tidak ditemukan');
        }
        
        return view('registration.show', compact('registrationPage'));
    }
    
    /**
     * Check if registration is currently open for a page
     */
    public static function isRegistrationOpen(RegistrationPage $page = null)
    {
        if (!$page) {
            return false;
        }
        
        $now = now();
        
        if (!$page->registration_start || !$page->registration_end) {
            return false;
        }
        
        $startDate = \Carbon\Carbon::parse($page->registration_start);
        $endDate = \Carbon\Carbon::parse($page->registration_end);
        
        return $now->between($startDate, $endDate);
    }
}
