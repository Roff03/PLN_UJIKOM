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
        Schema::create('pemakaians', function (Blueprint $table) {
            $table->id();
            $table->string('no_kontrol');
            $table->year('tahun');
            $table->string('bulan');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->integer('jumlah_pemakaian');
            $table->decimal('biaya_beban');
            $table->decimal('tarif_kwh');
            $table->integer('biaya_pemakaian');
            $table->string('status_pembayaran')->default('Belum Lunas'); // Status pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaians');
    }
};
