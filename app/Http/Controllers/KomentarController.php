<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Product;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $komentars = Komentar::where('product_id', $id)->with(['product', 'user'])->get(); // Ambil komentar untuk produk ini

        return response()->json($komentars);
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'isi_komentar' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Validasi user_id
        ]);

        $komentar = Komentar::create([
            'product_id' => $id,
            // 'user_id' => auth()->id(), // ID pengguna yang sedang login
            'user_id' => $request->user_id,
            'isi_komentar' => $request->isi_komentar,
            'balasan_komentar' => null, // Untuk komentar utama
        ]);
        return response()->json($komentar, 201);
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'balasan_komentar' => 'required|string|max:255',
        ]);

        // Temukan komentar yang akan dibalas
        $komentar = Komentar::findOrFail($id);
        $komentar->balasan_komentar = $request->balasan_komentar;
        $komentar->save();

        return response()->json($komentar, 201);
    }
}
