<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['lokasi', 'kategori', 'user'])->get();

        // Mengubah URL gambar menjadi URL lengkap untuk setiap produk
        foreach ($products as $product) {
            $product->image = url('storage/' . $product->image);
        }

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaproduct' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kondisi_barang' => 'required|string|max:255',
            'lokasi_id' => 'required|exists:lokasi,id',
            'kategori_id' => 'required|exists:kategori,id',
            'user_id' => 'required|exists:users,id', // Validasi user_id
            'tanggal_publish' => 'required|date',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Atau bisa menggunakan validasi file jika Anda mengupload gambar
            'is_sold' => 'required|numeric',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar di folder public/images
        }

        // Membuat produk baru
        $product = Product::create(array_merge($request->all(), ['image' => $imagePath]));
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['lokasi', 'kategori', 'user'])->findOrFail($id);

        // Menambahkan URL lengkap untuk gambar
        if ($product->image) {
            // $product->image = asset('storage/' . $product->image);
            $product->image = url('storage/' . $product->image);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'namaproduct' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|numeric',
            'kondisi_barang' => 'sometimes|required|string|max:255',
            'lokasi_id' => 'sometimes|required|exists:lokasi,id',
            'kategori_id' => 'sometimes|required|exists:kategori,id',
            'user_id' => 'sometimes|required|exists:users,id', // Validasi user_id
            'tanggal_publish' => 'sometimes|required|date',
            'deskripsi_produk' => 'sometimes|nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_sold' => 'sometimes|required|numeric',
        ]);

        $product = Product::findOrFail($id);
        // Memperbarui produk
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar baru
            $product->image = $imagePath; // Update path gambar
        }

        // Memperbarui produk
        $product->update($request->except('image')); // Update produk tanpa mengubah gambar
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // Menghapus produk
        $product->delete();
        return response()->json(null, 204);
    }
}
