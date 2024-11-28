<?php

namespace App\Exports;

use App\Models\Produk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Ambil data untuk diekspor sesuai filter.
     */
    public function collection()
    {
        $query = Produk::query();

        // Penerapan pencarian
        if (!empty($this->filters['search'])) {
            $query->where('name', 'like', '%' . $this->filters['search'] . '%');
        }

        // Penerapan filter kategori
        if (!empty($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }

        // Ambil data produk dan tambahkan nomor urut
        return $query->get()->map(function ($produk, $index) {
            return [
                $index + 1, // Menambahkan nomor urut
                $produk->name,
                $produk->category->name ?? 'Tidak Ada',
                $produk->price_buy,
                $produk->price_sell,
                $produk->stok,
            ];
        });
    }

    /**
     * Tambahkan header kolom.
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Kategori Produk',
            'Harga Barang',
            'Harga Jual',
            'Stok',
        ];
    }
}
