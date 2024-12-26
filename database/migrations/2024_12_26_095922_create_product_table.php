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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('namaproduct');
            $table->decimal('harga', 10, 2);
            $table->string('kondisi_barang');
            $table->foreignId('lokasi_id')->constrained('lokasi');
            $table->foreignId('kategori_id')->constrained('kategori');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tanggal_publish');
            $table->text('deskripsi_produk')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
