<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function showCreate()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('produk.create', compact('categories'));
    }

    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:produk,name',
            'buyPrice' => 'required|numeric|min:0',
            'salePrice' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'itemImage' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses upload gambar
        $imagePath = null;
        if ($request->hasFile('itemImage')) {
            $imagePath = $request->file('itemImage')->store('produks', 'public');
        }

        // Menyimpan produk menggunakan prepared statement
        DB::insert('INSERT INTO produk (name, category_id, price_buy, price_sell, stok, image, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->name,
            $request->category_id,
            preg_replace('/\D/', '', $request->buyPrice),
            preg_replace('/\D/', '', $request->salePrice),
            $request->stock,
            $imagePath ?? null,
            now(),
            now(),
        ]);

        // Mengarahkan kembali ke halaman produk dengan pesan sukses
        return redirect()->route('showIndex')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $categories = Category::all();

        return view('produk.edit', compact('produk', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:produk,name,' . $id, // Menambahkan pengecualian untuk produk yang sedang diupdate
            'category_id' => 'required|exists:category,id',
            'buyPrice' => 'required|numeric|min:0',
            'salePrice' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'itemImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produk = Produk::findOrFail($id);

        $imagePath = $produk->image; // Default ke gambar yang sudah ada
        if ($request->hasFile('itemImage')) {
            // Hapus gambar lama (opsional)
            if ($produk->image && file_exists(storage_path('app/public/' . $produk->image))) {
                unlink(storage_path('app/public/' . $produk->image));
            }

            // Simpan gambar baru
            $imagePath = $request->file('itemImage')->store('produks', 'public');
        }

        // Update produk menggunakan prepared statement
        DB::update('UPDATE produk SET name = ?, category_id = ?, price_buy = ?, price_sell = ?, stok = ?, image = ?, updated_at = ? 
                WHERE id = ?', [
            $request->name,
            $request->category_id,
            preg_replace('/\D/', '', $request->buyPrice),
            preg_replace('/\D/', '', $request->salePrice),
            $request->stock,
            $imagePath,
            now(),
            $id,
        ]);

        return redirect()->route('showIndex')->with('success', 'Produk berhasil diperbarui');
    }


    public function delete($id)
    {
        DB::delete('DELETE FROM produk WHERE id = ?', [$id]);

        return redirect()->route('showIndex');
    }
}
