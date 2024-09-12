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
        Schema::create('overtime', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idBagian');
            $table->date('tanggalOT');
            $table->date('tanggalAcc')->nullable();
            $table->date('tanggalApp')->nullable();
            $table->date('tanggalCancel')->nullable();
            $table->timestamps();

            $table->foreign('idBagian')->references('id')->on('bagian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtima');
    }
};
