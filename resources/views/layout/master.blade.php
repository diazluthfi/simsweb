<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMS Web</title>
    <link rel="icon" href="{{ asset('assets/Handbag.png') }}" type="image/x-icon">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <style>
      /* Sidebar Styling */
      #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        background-color: #f42619;
        transition: width 0.5s ease;
        z-index: 1000;
      }

      #sidebar.collapsed {
        width: 50px; /* Sidebar mengecil */
      }

 /* Sidebar Header Styling */
#sidebarHeader {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  background-color: #f42619;
  color: white;
}

.app-name {
  font-size: 18px;
  display: inline;
}
#sidebar.collapsed .app-name,
#sidebar.collapsed #sidebarIcon {  /* Menyembunyikan ikon juga saat sidebar collapsed */
  display: none;
}
      /* Sidebar Menu Items */
      .nav-link {
        color: white;
        display: flex;
        align-items: center;
        padding: 15px;
        transition: background-color 0.3s ease;
        text-decoration: none;
      }

      .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
      }

      .nav-link .text {
        margin-left: 10px;
        display: inline;
      }

      #sidebar.collapsed .nav-link .text {
        display: none;
      }

      .nav-link i {
        font-size: 20px;
      }

      /* Konten Utama */
      .main-content {
        margin-left: 250px; /* Default: sesuai lebar sidebar */
        flex-grow: 1;
        transition: margin-left 0.5s ease;
        overflow-x: hidden; /* Pastikan konten tidak meluas horizontal */
      }

      body.sidebar-collapsed .main-content {
        margin-left: 80px;
      }

      /* Tombol Toggle */
      #sidebarToggleBtn {
        background: transparent;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
      }

      .table-wrapper {
        overflow-x: auto;
        width: 100%;
      }

      table {
        width: 100%;
        table-layout: fixed;
        word-wrap: break-word;
      }

      .container-fluid {
        max-width: 100vw; 
        padding: 20px;
      }

      
      .table-actions {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
      }

      .table-actions .btn {
        margin-left: 10px;
      }


    </style>
  </head>
  <body>
    <!-- Sidebar -->
    <div id="sidebar">
      <!-- Sidebar Header -->
      <div id="sidebarHeader">
        <i id="sidebarIcon" class="bi bi-handbag p-0"></i>
        <h5 class="m-0 app-name">SIMS Web PHP</h5>
        <button id="sidebarToggleBtn" class="p-0">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <!-- Sidebar Menu -->
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{route('showIndex')}}">
            <i class="bi bi-box-seam"></i> <span class="text">Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('showProfile')}}">
            <i class="bi bi-person"></i> <span class="text">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-right"></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <div class="container-fluid">
        @yield('content')
        </div>

    </div>
   <!-- Modal Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Pembaruan Produk Berhasil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Produk berhasil diperbarui!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal untuk menampilkan error -->
@if ($errors->any())
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Ada Kesalahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p>Silakan perbaiki kesalahan di atas sebelum melanjutkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Perbaiki</button>
                </div>
            </div>
        </div>
    </div>
@endif
    <script>
      @if ($errors->any())
          var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
          myModal.show();
      @endif
  
      // Fungsi untuk memformat harga agar ada pemisah ribuan
      function formatPrice(input) {
          let value = input.value.replace(/\D/g, ''); // Hapus karakter non-angka
          if (value) {
              input.value = parseInt(value, 10).toLocaleString('id-ID'); // Format dengan titik
          } else {
              input.value = '';
          }
      }
  
      // Fungsi untuk menghitung harga jual otomatis (30% lebih mahal dari harga beli)
      function calculateSalePrice() {
          const buyPriceElement = document.getElementById('buyPrice');
          let buyPrice = buyPriceElement.value.replace(/\./g, ''); // Hapus pemisah ribuan
  
          // Pastikan harga beli adalah angka valid
          if (buyPrice) {
              buyPrice = parseFloat(buyPrice);
              const salePriceElement = document.getElementById('salePrice');
  
              // Hitung harga jual 30% lebih mahal dari harga beli
              const calculatedPrice = buyPrice * 1.3;
              salePriceElement.value = calculatedPrice.toLocaleString('id-ID'); // Format hasil dengan pemisah ribuan
          } else {
              document.getElementById('salePrice').value = ''; // Jika harga beli kosong, kosongkan harga jual
          }
      }
  
      // Panggil fungsi untuk menghitung harga jual otomatis saat halaman dimuat
      document.querySelector('form').addEventListener('submit', function () {
          const buyPriceElement = document.getElementById('buyPrice');
          buyPriceElement.value = buyPriceElement.value.replace(/\./g, ''); // Hapus titik pemisah
          const salePriceElement = document.getElementById('salePrice');
          salePriceElement.value = salePriceElement.value.replace(/\./g, ''); // Hapus titik pemisah
      });
  </script>
    
    <!-- Bootstrap 5 JS Bundle and Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    
    <!-- CSS Bootstrap -->

    <!-- JavaScript -->
    <script>
      const sidebar = document.getElementById("sidebar");
      const sidebarToggleBtn = document.getElementById("sidebarToggleBtn");
      const body = document.body;

      sidebarToggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        body.classList.toggle("sidebar-collapsed");
      });
    </script>
  </body>
</html>
