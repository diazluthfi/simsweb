<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <title>Halo</title>
  </head>
  <body>
    <div class="container-fluid">
      <!-- Row -->
      <div class="row">
        <!-- Kolom 1 -->
        <div
          class="col bg-white d-flex align-items-center justify-content-center vh-100"
        >
          <div class="w-50">
            <h5 class="text-center mb-4">
              <i class="bi bi-handbag" style="color: #f13b2f"></i> SIMS Web PHP
            </h5>
            <h3 class="text-center mb-4">Masuk atau buat akun untuk memulai</h3>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="input-group mb-4">
                <span
                  class="input-group-text"
                  style="cursor: pointer; background: transparent; color: #dbd8d8;"
                >@</span>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Masukkan email Anda"
                  required
                  style="border-left: none; border-color: #dbd8d8"
                />
              </div>
              <div class="input-group mb-4">
                <span
                  class="input-group-text"
                  style="cursor: pointer; background: transparent; color: #dbd8d8;"
                >
                  <i class="bi bi-lock"></i>
                </span>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  placeholder="Masukkan password Anda"
                  required
                  style="border-right: none; border-left: none; border-color: #dbd8d8;"
                />
                <span
                  class="input-group-text"
                  style="cursor: pointer; background: transparent; border-left: none; color: #dbd8d8;"
                >
                  <i class="bi bi-eye"></i>
                </span>
              </div>
              <button
                type="submit"
                class="btn w-100 text-white mt-4"
                style="background-color: #f13b2f"
              >
                Masuk
              </button>
            </form>
          </div>
        </div>

        <!-- Kolom 2 -->
        <div
          class="col text-center text-white py-4"
          style="background-image: url('{{ asset('assets/Frame 98699.png') }}'); background-size: cover; background-position: center;"
        ></div>
      </div>
    </div>

    <!-- Modal Error Password -->
    <div class="modal fade" id="passwordErrorModal" tabindex="-1" aria-labelledby="passwordErrorModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="passwordErrorModalLabel">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Password yang Anda masukkan salah. Silakan coba lagi.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Coba Lagi</button>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!-- Script to show error modal -->
    <script>
      @if(session('loginError'))
        var myModal = new bootstrap.Modal(document.getElementById('passwordErrorModal'), {});
        myModal.show();
      @endif
    </script>
  </body>
</html>
