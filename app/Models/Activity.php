<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'alt_text',
        'activity_date',
        'is_active',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'activity_date' => 'date',
        'order' => 'integer',
    ];

    /**
     * Get the galleries for the activity.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Get the first gallery for the activity.
     */
    public function firstGallery()
    {
        return $this->hasOne(Gallery::class)
                    ->where('is_active', true)
                    ->oldest('order');
    }

    /**
     * Get the thumbnail gallery for the activity.
     */
    public function thumbnailGallery()
    {
        return $this->hasOne(Gallery::class)
                    ->where('is_active', true)
                    ->where(function($query) {
                        $query->where('is_thumbnail', true)
                              ->orWhereRaw('id = (
                                  SELECT MIN(g2.id) 
                                  FROM galleries g2 
                                  WHERE g2.activity_id = galleries.activity_id 
                                  AND g2.is_active = true
                              )');
                    })
                    ->orderBy('order', 'asc');
    }

    /**
     * Scope a query to only include active activities.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order activities by the order field.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
