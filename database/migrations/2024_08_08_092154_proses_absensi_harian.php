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
        Schema::create('prosesAbsensiHarian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->date('tglAbsen');
            $table->time('jamDatang')->nullable();
            $table->time('jamPulang')->nullable();
            $table->enum('terlambat', ['Ya', 'Tidak']);
            $table->enum('full', ['Ya', 'Tidak']);
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prosesAbsensiHarian');
    }
};
