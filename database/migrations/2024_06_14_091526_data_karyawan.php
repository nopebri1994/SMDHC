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
        Schema::create('dataKaryawan', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nikKerja')->unique();
            $table->String('namaKaryawan');
            $table->date('tglMasuk');
            $table->enum('jenisKelamin', ['1', '2']);
            $table->unsignedBigInteger('idPerusahaan');
            $table->unsignedBigInteger('idDepartemen');
            $table->unsignedBigInteger('idBagian')->nullable();
            $table->enum('statusKaryawan', ['1', '2', '3', '4']);
            //1 = Kontrak, 2 = tetap, 3, = Honorer, 4 = Harian
            $table->integer('fpId')->unique();
            $table->unsignedBigInteger('idJabatan');
            $table->unsignedBigInteger('idJamKerja');
            $table->timestamps();
            //foreignKey
            $table->foreign('idPerusahaan')->references('id')->on('perusahaan');
            $table->foreign('idDepartemen')->references('id')->on('departemen');
            $table->foreign('idBagian')->references('id')->on('bagian');
            $table->foreign('idJabatan')->references('id')->on('jabatan');
            $table->foreign('idJamKerja')->references('id')->on('jamKerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataKaryawan');
    }
};
