<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'namaproduct',
        'harga',
        'kondisi_barang',
        'lokasi_id',
        'kategori_id',
        'user_id',
        'tanggal_publish',
        'deskripsi',
        'image',
        'is_sold',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relasi ke model User
    }
}
