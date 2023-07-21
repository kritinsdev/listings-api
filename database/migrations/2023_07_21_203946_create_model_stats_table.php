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
        Schema::create('model_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->constrained('phone_models');
            $table->integer('count');
            $table->decimal('average_price', 8, 2);
            $table->decimal('lowest_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_stats');
    }
};
