<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'seller_id',
        'buyer_id',
        'product_id',
        'metode_pembayaran',
        'alamat',
        'bukti_pembayaran',
    ];

    // Relasi ke model User (Seller)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relasi ke model User (Buyer)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Relasi ke model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
