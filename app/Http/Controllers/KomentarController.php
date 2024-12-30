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
        $komentars = Komentar::where('product_id', $id)->with('user')->get(); // Ambil komentar untuk produk ini

        return response()->json($komentars);
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'isi_komentar' => 'required|string|max:255',
        ]);

        $komentar = Komentar::create([
            'product_id' => $id,
            'user_id' => auth()->id(), // ID pengguna yang sedang login
            'isi_komentar' => $request->isi_komentar,
            'balasan_komentar' => null, // Untuk komentar utama
        ]);
        return response()->json($komentar, 201);
    }

    public function storeReply(Request $request, $id, $komentarId)
    {
        $request->validate([
            'balasan_komentar' => 'required|string|max:255',
        ]);

        // Temukan komentar yang akan dibalas
        $komentar = Komentar::findOrFail($komentarId);
        $komentar->balasan_komentar = $request->balasan_komentar;
        $komentar->save();

        return response()->json($komentar, 201);
    }
}