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
        Schema::create('potongCuti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->year('tahunCuti');
            $table->integer('jumlahPotong');
            $table->enum('status', ['Sudah', 'Belum']);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potongCuti');
    }
};
