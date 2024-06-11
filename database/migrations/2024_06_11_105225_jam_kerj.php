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
        Schema::create('jamKerja', function (Blueprint $table) {
            $table->id();
            $table->string('kodeJamKerja', 5);
            $table->time('jamMasukSJ');
            $table->time('jamPulangSJ');
            $table->time('jamMasukS');
            $table->time('jamPulangS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jamKerja');
    }
};
