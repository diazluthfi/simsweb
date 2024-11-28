@extends('layout.master')
@section('content')

<div class="container-fluid">
    <div class="container mb-4 p-0">
        <h2 class="fw-bold fs-3 text-secondary d-inline">Daftar Produk</h2>
        <span class="fw-bold fs-3 text-dark d-inline"> &gt; </span>
        <h2 class="fw-bold fs-3 text-dark d-inline">Tambah Produk</h2>
    </div>
    <form action="{{ route('produk.create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="itemCategory" class="form-label">Kategori</label>
                <select class="form-select" id="itemCategory" name="category_id" required>
                    <option value="" disabled selected>Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-8">
                <label for="name" class="form-label">Nama Barang</label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    placeholder="Masukkan nama barang"
                    required
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="buyPrice" class="form-label">Harga Beli</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: transparent;">Rp.</span>
                    <input
                        type="text"
                        class="form-control @error('buyPrice') is-invalid @enderror"
                        id="buyPrice"
                        name="buyPrice"
                        placeholder="Masukkan harga beli"
                        required
                        onkeyup="formatPrice(this); calculateSalePrice();"
                    />
                    @error('buyPrice')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <label for="salePrice" class="form-label">Harga Jual</label>
                <div class="input-group">
                    <span class="input-group-text" style="background: transparent;">Rp.</span>
                    <input
                        type="text"
                        class="form-control @error('salePrice') is-invalid @enderror"
                        id="salePrice"
                        name="salePrice"
                        placeholder="Harga Jual Otomatis"
                        required
                        readonly
                    />
                    @error('salePrice')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <label for="stock" class="form-label">Stok Barang</label>
                <input
                    type="number"
                    class="form-control @error('stock') is-invalid @enderror"
                    id="stock"
                    name="stock"
                    placeholder="Masukkan stok barang"
                    required
                />
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="itemImage" class="form-label">Upload Image</label>
            <input
                type="file"
                class="form-control @error('itemImage') is-invalid @enderror"
                id="itemImage"
                name="itemImage"
                accept="image/*"
                required
            />
            @error('itemImage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('showIndex') }}" class="btn btn-outline-primary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        
    </form>

</div>


<!-- JavaScript untuk menampilkan modal otomatis jika ada error -->


@endsection
