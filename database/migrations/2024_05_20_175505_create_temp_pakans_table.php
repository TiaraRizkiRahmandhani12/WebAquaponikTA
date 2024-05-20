<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('temp_pakans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pakan_id');
            $table->time('jam_pertama');
            $table->time('jam_kedua');
            $table->time('jam_ketiga');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_pakans');
    }
};
