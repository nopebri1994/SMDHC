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
        Schema::create('fkp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->enum('typePelatihan', ['1', '2', '3', '4', '0'])->comment('Type Kebutuhan Pelatihan');
            $table->text('typeLain')->nullable();
            $table->enum('jenisPelatihan', ['1', '2', '3', '4', '5', '0']);
            $table->text('jenisLain')->nullable();
            $table->date('tglMulai');
            $table->date('tglSelesai');
            $table->text('file');
            $table->timestamps();

            $table->foreign('idKaryawan')->references('id')->on('dataKaryawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fkp');
    }
};
