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
        Schema::create('advance', function (Blueprint $table) {
            $table->string('no_pinjaman')->primary();
            $table->unsignedBigInteger('idKaryawan');
            $table->bigInteger('totalPinjaman');
            $table->integer('totalPotongan');
            $table->integer('sisaPotongan');
            $table->bigInteger('sudahDipotong');
            $table->date('tanggalRealisasi');
            $table->enum('status', ['1', '2']);
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advance');
    }
};
