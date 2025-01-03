<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['seller', 'buyer', 'product'])->get();

        foreach ($transactions as $transaction) {
            $transaction->bukti_pembayaran = url('storage/' . $transaction->bukti_pembayaran);
        }

        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'buyer_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:product,id',
            'metode_pembayaran' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file
        ]);

        // Mengunggah bukti pembayaran jika ada
        $filePath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public'); // Simpan file
        }

        $transaction = Transaction::create(array_merge($request->all(), ['bukti_pembayaran' => $filePath]));
        $product = Product::findOrFail($request['product_id']);
        $product->is_sold = 1;
        $product->save();

        return response()->json($transaction, 201); // Mengembalikan respons JSON
    }


    public function show($id)
    {
        $transaction = Transaction::with(['seller', 'buyer', 'product'])->findOrFail($id);
        return response()->json($transaction);
    }

    public function showByBuyerId($id)
    {
        $buyer = User::findOrFail($id);
        $transactions = Transaction::where('buyer_id', $id)->with(['seller', 'buyer', 'product'])->get();

        return response()->json($transactions);
    }

}
