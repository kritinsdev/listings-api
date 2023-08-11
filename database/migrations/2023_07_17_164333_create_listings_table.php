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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreign('model_id')->references('id')->on('listing_models');
            $table->unsignedBigInteger('model_id');
            $table->double('price')->required();
            $table->integer('memory')->nullable();
            $table->string('added')->required();
            $table->string('url')->unique();
            $table->string('site')->required();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
