<?php

namespace Database\Seeders;

use App\Models\Komentar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Komentar::create([
            'product_id' => 1,
            'user_id' => 2,
            'isi_komentar' => 'Bisa turun dikit gak gan?',
            'balasan_komentar' => 'Maaf, harga sudah pas ya gan.',
        ]);
        Komentar::create([
            'product_id' => 1,
            'user_id' => 3,
            'isi_komentar' => 'tanggung ke 90k bisa ga hehe, itung-itung sekalian ongkir',
            'balasan_komentar' => null,
        ]);
    }
}
