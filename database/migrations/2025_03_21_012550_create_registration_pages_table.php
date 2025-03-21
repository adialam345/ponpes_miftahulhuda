<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registration_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_type'); // 'pondok' or 'smp'
            $table->string('title');
            $table->longText('content');
            $table->json('requirements')->nullable();
            $table->json('procedures')->nullable();
            $table->json('documents')->nullable();
            $table->json('contacts')->nullable();
            $table->date('registration_start')->nullable();
            $table->date('registration_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_pages');
    }
};
