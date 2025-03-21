<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationPage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'page_type',
        'title',
        'content',
        'requirements',
        'procedures',
        'documents',
        'contacts',
        'registration_start',
        'registration_end',
    ];
    
    protected $casts = [
        'requirements' => 'array',
        'procedures' => 'array',
        'documents' => 'array',
        'contacts' => 'array',
        'registration_start' => 'date',
        'registration_end' => 'date',
    ];
    
    /**
     * Check if registration is currently open
     */
    public function isRegistrationOpen(): bool
    {
        if (is_null($this->registration_start) || is_null($this->registration_end)) {
            return false;
        }
        
        $today = now()->startOfDay();
        return $today->between($this->registration_start, $this->registration_end);
    }
}
