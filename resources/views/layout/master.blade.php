<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMS Web</title>
    <link rel="icon" href="{{ asset('assets/Handbag.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
  
  </head>
  <body>
    <!-- Sidebar -->
    <div id="sidebar">
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

    <!-- Main Content -->
    <div class="main-content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>

    @if ($errors->any())
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold d-flex align-items-center" id="errorModalLabel">
                        <i class="bi bi-exclamation-circle me-2"></i> Kesalahan Input
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <p class="mb-1"><strong>Harap periksa kesalahan berikut:</strong></p>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            @endif
        });



      function formatPrice(input) {
        let value = input.value.replace(/\D/g, ''); 
        if (value) {
          input.value = parseInt(value, 10).toLocaleString('id-ID'); 
        } else {
          input.value = '';
        }
      }

      function calculateSalePrice() {
        const buyPriceElement = document.getElementById('buyPrice');
        let buyPrice = buyPriceElement.value.replace(/\./g, ''); 
        if (buyPrice) {
          buyPrice = parseFloat(buyPrice);
          const salePriceElement = document.getElementById('salePrice');
          const calculatedPrice = buyPrice * 1.3;
          salePriceElement.value = calculatedPrice.toLocaleString('id-ID'); 
        } else {
          document.getElementById('salePrice').value = '';
        }
      }

      document.querySelector('form').addEventListener('submit', function () {
        const buyPriceElement = document.getElementById('buyPrice');
        buyPriceElement.value = buyPriceElement.value.replace(/\./g, ''); 
        const salePriceElement = document.getElementById('salePrice');
        salePriceElement.value = salePriceElement.value.replace(/\./g, ''); 
      });
    </script>

    <!-- Bootstrap 5 JS Bundle and Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

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
