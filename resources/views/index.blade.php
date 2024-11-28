@extends('layout.master')

@section('content')
<div class="container-fluid">
    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-4 mt-4">
        <h2>Daftar Produk</h2>
    </div>

    <!-- Tombol di atas tabel -->
    <div class="d-flex mb-3 justify-content-between">
        <div class="d-flex">
            <form action="{{ route('showIndex') }}" method="GET" class="d-flex">
                <div class="input-group mb-3">
                    <button type="submit" class="btn" style="background-color: transparent; color: #dbd8d8; border: 1px solid #dbd8d8;">
                        <i class="bi bi-search"></i>
                    </button>
                    
                    <input
                        type="text"
                        value="{{ request('search') }}"
                        name="search"
                        class="form-control col-2"
                        placeholder="Cari Barang"
                        style="border-left: none; border-color: #dbd8d8" />
                </div>
            </form>
    
            <div class="ms-3">
                <form action="{{ route('showIndex') }}" method="GET">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle text-black pr-4 pl-4"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="background-color: white">
                            <i class="bi bi-box-seam" style="margin-right: 10px"></i>
                            @if(request('category_id'))
                                {{ $categories->find(request('category_id'))->name }}
                            @else
                                Semua
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('showIndex') }}">Semua</a></li>
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('showIndex', ['category_id' => $category->id]) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </form>
            </div>            
        </div>
    
        <div class="d-flex align-items-center">
            <a href="{{ route('produk.export', request()->query()) }}" class="btn btn-success ms-2">
                <img src="{{ asset('assets/MicrosoftExcelLogo.png') }}" alt="Export Excel"
                     style="width: 20px; height: 20px; margin-right: 8px" />
                Export Excel
            </a>
            
            <a href="{{ route('produk.showCreate') }}" class="btn btn-danger ms-2">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="table-wrapper">
        <table class="table border">
            <thead style="background-color: #f9f9f9">
                <tr>
                    <th scope="col" class="border-0">No</th>
                    <th scope="col" class="border-0">Gambar</th>
                    <th scope="col" class="border-0">Nama Produk</th>
                    <th scope="col" class="border-0">Kategori Produk</th>
                    <th scope="col" class="border-0">Harga Beli (Rp)</th>
                    <th scope="col" class="border-0">Harga Jual (Rp)</th>
                    <th scope="col" class="border-0">Stok Produk</th>
                    <th scope="col" class="border-0">Aksi</th>
                </tr>
            </thead>
            <tbody style="background-color: white">
                @foreach ($produks as $key => $produk)
                    <tr>
                        <td class="border-0">{{ $produks->firstItem() + $key }}</td>
                        <td class="border-0" style="display: flex; justify-content: left; align-items: center; width: 100%; height: auto;">
                            <img 
                                src="{{ asset('storage/' . $produk->image) }}" 
                                alt="Gambar Produk" 
                                style="max-width: 100%; height: 50px; object-fit: contain;">
                        </td>
                        <td class="border-0">{{ $produk->name }}</td>
                        <td class="border-0">{{ $produk->category->name }}</td>
                        <td class="border-0">Rp{{ number_format($produk->price_buy, 0, ',', '.') }}</td>
                        <td class="border-0">Rp{{ number_format($produk->price_sell, 0, ',', '.') }}</td>
                        <td class="border-0">{{ $produk->stok }}</td>
                        <td class="border-0">
                            <a href="{{ route('produk.edit', ['id' => $produk->id]) }}" type="button" style="font-size: 1.2rem; color: #0d6efd;">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <!-- Trigger Modal Delete -->
                            <a href="#" class="delete-btn" data-id="{{ $produk->id }}" data-nama="{{ $produk->name }}">
                                <i class="bi bi-trash-fill" style="color: red; font-size: 1.2rem;"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-0 d-flex justify-content-between align-items-center">
            <span>Show {{ $produks->count() }} from {{ $produks->total() }}</span>
        
            <!-- Pagination -->
            <div class="d-flex align-items-center">
                @if ($produks->onFirstPage())
                    <button class="btn" style="border: none; color: grey; font-weight: bold; cursor: not-allowed;">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                @else
                    <a href="{{ $produks->previousPageUrl() }}" class="btn" style="border: none; color: black; font-weight: bold; cursor: pointer;">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                @endif
        
                @for ($i = 1; $i <= $produks->lastPage(); $i++)
                    @if ($i == 1 || $i == $produks->lastPage() || ($i >= $produks->currentPage() - 1 && $i <= $produks->currentPage() + 1))
                        <a href="{{ $produks->url($i) }}" class="btn" style="border: none; color: {{ $produks->currentPage() == $i ? 'black' : 'grey' }}; font-weight: {{ $produks->currentPage() == $i ? 'bold' : 'normal' }};">
                            {{ $i }}
                        </a>
                    @elseif ($i == $produks->currentPage() - 2 || $i == $produks->currentPage() + 2)
                        <span style="font-weight: bold;">...</span>
                    @endif
                @endfor
        
                @if ($produks->hasMorePages())
                    <a href="{{ $produks->nextPageUrl() }}" class="btn" style="border: none; color: black; font-weight: bold; cursor: pointer;">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                @else
                    <button class="btn" style="border: none; color: grey; font-weight: bold; cursor: not-allowed;">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                @endif
            </div>
        </div>
        
    </div>
</div>

<!-- Modal for Confirming Deletion -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk <strong id="namaProduk"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Jika ada pesan sukses dari session
        @if(session('success'))
            var successMessage = '{{ session('success') }}';
            alert(successMessage); // Atau gunakan modal atau tampilan pop-up lainnya
        @endif

        // Aksi tombol hapus produk
        var deleteBtns = document.querySelectorAll('.delete-btn');

        deleteBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var produkId = btn.getAttribute('data-id');
                var produkName = btn.getAttribute('data-nama');
                
                // Update modal dengan nama produk yang akan dihapus
                document.getElementById('namaProduk').textContent = produkName;
                
                // Set form action untuk penghapusan produk
                var form = document.getElementById('deleteForm');
                form.action = '/produk/delete/' + produkId;
                
                // Tampilkan modal
                var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                myModal.show();
            });
        });
    });
</script>
@endsection
