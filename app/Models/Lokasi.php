<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = ['nama'];

    // Relasi dengan produk
    public function products()
    {
        return $this->hasMany(Product::class, 'lokasi_id');
    }
}
