<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create(['nama' => 'Mouse']);
        Kategori::create(['nama' => 'Headset']);
        Kategori::create(['nama' => 'Keyboard']);
        Kategori::create(['nama' => 'VGA']);
        Kategori::create(['nama' => 'RAM']);
        Kategori::create(['nama' => 'Monitor']);
        Kategori::create(['nama' => 'Laptop']);
        Kategori::create(['nama' => 'PC']);
        Kategori::create(['nama' => 'Microphone']);
        Kategori::create(['nama' => 'Phone']);
        Kategori::create(['nama' => 'Camera']);
    }
}
