<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrationPages = RegistrationPage::all();
        return view('admin.registration.index', compact('registrationPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->query('type') ?? '';
        return view('admin.registration.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateRegistrationPage($request);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Process array inputs
        $data = $this->processInputData($request);
        
        RegistrationPage::create($data);
        
        return redirect()->route('admin.registration.index')
            ->with('success', 'Halaman pendaftaran berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registrationPage = RegistrationPage::findOrFail($id);
        return view('admin.registration.show', compact('registrationPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registrationPage = RegistrationPage::findOrFail($id);
        return view('admin.registration.edit', compact('registrationPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->validateRegistrationPage($request);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $registrationPage = RegistrationPage::findOrFail($id);
        
        // Process array inputs
        $data = $this->processInputData($request);
        
        $registrationPage->update($data);
        
        return redirect()->route('admin.registration.index')
            ->with('success', 'Halaman pendaftaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registrationPage = RegistrationPage::findOrFail($id);
        $registrationPage->delete();
        
        return redirect()->route('admin.registration.index')
            ->with('success', 'Halaman pendaftaran berhasil dihapus!');
    }
    
    /**
     * Validate the registration page data.
     */
    private function validateRegistrationPage(Request $request)
    {
        $rules = [
            'page_type' => 'required|in:pondok,smp',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'registration_start' => 'nullable|date',
            'registration_end' => 'nullable|date|after_or_equal:registration_start',
            'requirements' => 'nullable|array',
            'procedures' => 'nullable|array',
            'documents' => 'nullable|array',
            'contacts' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            'procedures.*' => 'nullable|string',
            'documents.*' => 'nullable|string',
            'contacts.*' => 'nullable|string',
        ];
        
        return Validator::make($request->all(), $rules);
    }
    
    /**
     * Process array inputs from the form.
     */
    private function processInputData(Request $request)
    {
        $data = $request->only([
            'page_type',
            'title',
            'content',
            'registration_start',
            'registration_end',
        ]);
        
        // Process array inputs - remove empty values
        foreach (['requirements', 'procedures', 'documents', 'contacts'] as $field) {
            if ($request->has($field)) {
                $data[$field] = array_filter($request->input($field) ?? [], function ($item) {
                    return !empty(trim($item));
                });
            }
        }
        
        return $data;
    }

    /**
     * Clear the content of a registration page
     */
    public function clearContent(string $id)
    {
        $registrationPage = RegistrationPage::findOrFail($id);
        $registrationPage->content = '';
        $registrationPage->requirements = [];
        $registrationPage->procedures = [];
        $registrationPage->documents = [];
        $registrationPage->contacts = [];
        $registrationPage->save();

        return redirect()->back()->with('success', 'Semua konten halaman pendaftaran berhasil dikosongkan!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $url = asset('storage/' . $path);
            return response()->json(['url' => $url]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
