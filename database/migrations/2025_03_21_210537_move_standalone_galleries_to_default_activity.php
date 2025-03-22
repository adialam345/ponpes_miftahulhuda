<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Activity;
use App\Models\Gallery;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if there are standalone galleries
        $standaloneGalleriesCount = Gallery::whereNull('activity_id')->count();
        
        if ($standaloneGalleriesCount > 0) {
            // Create a default activity for all standalone galleries
            $defaultActivity = Activity::create([
                'title' => 'Galeri Foto',
                'slug' => 'galeri-foto',
                'description' => 'Kumpulan foto-foto kegiatan pondok pesantren',
                'is_active' => true,
                'order' => Activity::max('order') ? Activity::max('order') + 1 : 1,
            ]);
            
            // Move all standalone galleries to this activity
            Gallery::whereNull('activity_id')->update([
                'activity_id' => $defaultActivity->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Find the default activity
        $defaultActivity = Activity::where('title', 'Galeri Foto')
                                ->where('slug', 'galeri-foto')
                                ->first();
                                
        if ($defaultActivity) {
            // Set activity_id to null for all galleries in this activity
            Gallery::where('activity_id', $defaultActivity->id)->update([
                'activity_id' => null
            ]);
            
            // Delete the default activity
            $defaultActivity->delete();
        }
    }
};
