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
        Schema::create('karyawanKontrak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->text('noKontrak');
            $table->date('dibuatTanggal');
            $table->date('berlakuTanggal');
            $table->date('sampaiTanggal');
            $table->enum('kontrakKe', ['1', '2', '3', '4', '5', '6']);
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawanKontrak');
    }
};
