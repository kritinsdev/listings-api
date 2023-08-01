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
        Schema::create('listing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->unique()->constrained('listings')->cascadeOnDelete();
            $table->integer('memory')->nullable();
            $table->string('full_title')->nullable();
            $table->text('description')->nullable();
            $table->integer('views')->nullable();
            $table->string('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_details');
    }
};
