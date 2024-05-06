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
        Schema::create('datasensor', function (Blueprint $table) {
            $table->id();
            $table->float('tds');
            $table->float('suhu');
            $table->float('jarak_air');
            $table->float('ph_air');
            $table->float('jarak_pakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasensors');
    }
};
