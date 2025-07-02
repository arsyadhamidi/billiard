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
            $table->increments('id');

            $table->unsignedInteger('users_id');
            $table->unsignedInteger('meja_id');
            $table->unsignedInteger('paket_id');

            $table->string('kode_booking', 7);
            $table->date('tgl_booking');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('status', ['1', '2', '3', '4']);
            $table->integer('total_harga');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();

            // Tambahkan foreign key secara eksplisit
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('meja_id')->references('id')->on('mejas')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
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
