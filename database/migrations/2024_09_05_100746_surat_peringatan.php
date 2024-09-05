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
        Schema::create('suratPeringatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKaryawan');
            $table->text('nomorSP');
            $table->date('dibuatTanggal');
            $table->date('berlakuTanggal');
            $table->date('sampaiTanggal');
            $table->enum('sp', ['1', '2', '3']);
            $table->enum('status', ['1', '2'])->comment('1 = Aktif, 2=non Aktif');
            $table->text('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratPeringatan');
    }
};
