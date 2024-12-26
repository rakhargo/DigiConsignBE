<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Lokasi;
use App\Models\Kategori;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('images');

        Product::create([
            'namaproduct' => 'Vortexseries Oni R1',
            'harga' => 100000,
            'kondisi_barang' => 'Judge By Pict',
            'lokasi_id' => 1, // Pastikan ID ini ada di tabel lokasi
            'kategori_id' => 1, // Pastikan ID ini ada di tabel kategori
            'user_id' => 1, // Pastikan ID ini ada di tabel users
            'tanggal_publish' => now(),
            'deskripsi_produk' => 'Pemakaian 10 bulan, kondisi 99% mulus, Minus tampilan, kelengkapan fullset',
            'image' => $this->uploadImage('product1.jpeg'), // Mengunggah gambar
        ]);

        Product::create([
            'namaproduct' => 'Rexus Daxa Asteria V2',
            'harga' => 250000,
            'kondisi_barang' => 'Good Condition',
            'lokasi_id' => 1,
            'kategori_id' => 1,
            'user_id' => 2,
            'tanggal_publish' => now(),
            'deskripsi_produk' => 'Pemakaian 5 bulan, kondisi 90% mulus, Minus tampilan, kelengkapan fullset',
            'image' => $this->uploadImage('product2.jpeg'), // Mengunggah gambar
        ]);

        Product::create([
            'namaproduct' => 'Logitech M191',
            'harga' => 50000,
            'kondisi_barang' => 'Very Good Condition',
            'lokasi_id' => 5,
            'kategori_id' => 1,
            'user_id' => 3,
            'tanggal_publish' => now(),
            'deskripsi_produk' => 'Pemakaian 2 bulan, kondisi 95% mulus, kelengkapan fullset',
            'image' => $this->uploadImage('product3.jpeg'), // Mengunggah gambar
        ]);

    }

    private function uploadImage($filename)
    {
        // Simulasi mengunggah gambar dengan membuat file dummy
        $dummyImagePath = public_path('dummy_images/' . $filename); // Pastikan Anda memiliki folder dummy_images di public
        $destinationPath = storage_path('app/public/images/' . $filename);
        
        // Salin gambar dummy ke folder tujuan
        if (file_exists($dummyImagePath)) {
            copy($dummyImagePath, $destinationPath);
            return 'images/' . $filename; // Kembalikan path relatif
        }

        return null; // Jika gambar tidak ada, kembalikan null
    }
}
