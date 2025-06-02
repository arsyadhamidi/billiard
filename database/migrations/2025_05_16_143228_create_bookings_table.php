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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->integer('meja_id');
            $table->integer('paket_id');
            $table->string('kode_booking', '7');
            $table->date('tgl_booking');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('status', ['1', '2', '3', '4']);
            $table->integer('total_harga');
            $table->string('bukti_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
