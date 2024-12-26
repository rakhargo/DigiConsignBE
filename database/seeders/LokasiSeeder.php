<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lokasi::create(['nama' => 'Jakarta Utara']);
        Lokasi::create(['nama' => 'Jakarta Timur']);
        Lokasi::create(['nama' => 'Jakarta Selatan']);
        Lokasi::create(['nama' => 'Jakarta Barat']);
        Lokasi::create(['nama' => 'Jakarta Pusat']);
        Lokasi::create(['nama' => 'Bekasi']);
        Lokasi::create(['nama' => 'Bandung']);
        Lokasi::create(['nama' => 'Surabaya']);
        Lokasi::create(['nama' => 'Medan']);
    }
}
