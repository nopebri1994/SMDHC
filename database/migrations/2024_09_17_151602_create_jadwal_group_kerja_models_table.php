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
        Schema::create('jadwalGroupKerja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idGroupKerja');
            $table->unsignedBigInteger('idJamKerja');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('idGroupkerja')->references('id')->on('groupKerja');
            $table->foreign('idJamkerja')->references('id')->on('jamKerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwalGroupKerja');
    }
};
