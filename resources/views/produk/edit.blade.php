@extends('layout.master')
@section('content')

<div class="container-fluid">
    <div class="container mb-4 p-0">
        <h2 class="fw-bold fs-3 text-secondary d-inline">Daftar Produk</h2>
        <span class="fw-bold fs-3 text-dark d-inline"> &gt; </span>
        <h2 class="fw-bold fs-3 text-dark d-inline">Edit Produk</h2>
    </div>
    
    <!-- Form Edit Produk -->
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menggunakan method PUT untuk update data -->

        <!-- Baris Pertama: Kategori dan Nama Barang -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="itemCategory" class="form-label">Kategori</label>
                <select class="form-select" id="itemCategory" name="category_id" required>
                    <option value="" disabled>Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ $category->id == $produk->category_id ? 'selected' : '' }} >
                            {{ $category->name }}
                        </option>
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
                    value="{{ $produk->name }}"
                    required
                />
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
        </div>

        <!-- Baris Kedua: Harga dan Stok -->
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
                        value="{{ number_format($produk->price_buy, 0, ',', '.') }}"
                        required
                        oninput="formatPrice(this); calculateSalePrice();"
                        style="border-left: none; border-color: #dbd8d8"
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
                        value="{{ number_format($produk->price_sell, 0, ',', '.') }}"
                        required
                        readonly
                        style="border-left: none; border-color: #dbd8d8"
                    />
                    @error('buyPrice')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <label for="stock" class="form-label">Stok Barang</label>
                <input
                    type="number"
                   class="form-control @error('salePrice') is-invalid @enderror"
                    id="stock"
                    name="stock"
                    placeholder="Masukkan stok barang"
                    value="{{ $produk->stok }}"
                    required
                    min="0"
                />
                  @error('buyPrice')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input Gambar -->
        <div class="mb-3">
            <label for="itemImage" class="form-label">Uplod Image</label>
            <input
                type="file"
                class="form-control"
                id="itemImage"
                name="itemImage"
                accept="image/*"
            />
            <small class="text-muted">*Biarkan kosong jika tidak ingin mengubah gambar</small>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Update Barang</button>
    </form>
</div>



<!-- JavaScript -->


@endsection
