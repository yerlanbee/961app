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
        Schema::create('advantage_building', function (Blueprint $table) {
            $table->foreignId('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->foreignId('advantage_id')->constrained('advantages')->cascadeOnDelete();

            $table->string('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advantage_building');
    }
};
