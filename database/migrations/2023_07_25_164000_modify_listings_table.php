<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('memory');
            $table->dropColumn('battery_capacity');
            
            DB::statement('ALTER TABLE listings ADD COLUMN category_id BIGINT UNSIGNED AFTER model_id');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->integer('memory')->nullable();
            $table->integer('battery_capacity')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
