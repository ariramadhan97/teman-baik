<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

        <title>Login - TEMAN BAIK</title>

        <style>
            .bg-login {
                background-color: #8EC5FC;
                background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
            }

            .auth-card {
                max-width: 460px;
                width: 100%;
            }
        </style>
    </head>

    <body>
        <div class="vw-100 vh-100 bg-primary bg-gradient position-relative">
            <div class="position-absolute py-1 px-3">
                <a href="/" class="btn btn-outline-light rounded-pill px-3 py-1">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                    </svg>
                    Home
                </a>
            </div>
            <div class="d-flex align-items-center justify-content-center w-100 vh-100 flex-column">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
                        <div class="card mb-0 border-primary shadow">
                            <div class="card-body">
                                <img src="img/tb.png" alt="" class="w-50 d-block mx-auto" style="filter: brightness(0) saturate(100%) invert(30%) sepia(51%) saturate(5320%) hue-rotate(210deg) brightness(102%) contrast(98%);">
                                <div class="position-relative text-center mt-4 mb-5">
                                    <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                <form action="/login" method="post" id="loginForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control @if (session()->has('loginError')) is-invalid @endif" value="{{ old('username') }}" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control @if (session()->has('loginError')) is-invalid @endif" id="password" name="password" required>
                                    </div>
                                    <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-size="flexible" data-theme="light" data-callback="onTurnstileSuccess"></div>
                                    <div class="text-center small mb-2 text-danger">
                                        @if (session()->has('loginError'))
                                            username atau password salah
                                        @else
                                            &nbsp;
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 mt-1 mb-3 rounded-2" id="buttonLogin">Login</button>
                                </form>
                                <button type="button" class="btn btn-link d-block text-center text-decoration-none mx-auto" data-bs-toggle="modal" data-bs-target="#tentangKami">
                                    Tentang Kami
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-muted">
                    &copy; DPMPTSP Kota Banjarmasin
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tentangKami" tabindex="-1" aria-labelledby="tentangKamiLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tentangKamiLabel">Tentang Kami</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="text-align: justify">
                        <img src="img/tb.png" alt="" class="mb-2 w-25 d-block mx-auto" style="filter: brightness(0) saturate(100%) invert(30%) sepia(51%) saturate(5320%) hue-rotate(210deg) brightness(102%) contrast(98%);">
                        TEMAN BAIK merupakan akronim dari <b>Tem</b>pat penyampai<b>an</b> <b>B</b>erbagai <b>A</b>duan di Mal Pelayanan publ<b>ik</b>.<br>
                        Peraturan Presiden Nomor 89 Tahun 2021 tentang Penyelenggaraan Mal Pelayanan Publik menyebutkan bahwa sebagai Penyelenggara MPP, Dinas Penanaman Modal dan PTSP memiliki fungsi menyelenggarakan penyediaan mekanisme, pengelolaan dan penyelesaian pengaduan masyarakat yang terintegrasi atau terhubung dengan sistem pengelolaan pengaduan pelayanan publik nasional. Dalam rangka mewujudkan fungsi tersebut Dinas Penanaman Modal dan PTSP Kota Banjarmasin menghadirkan TEMAN BAIK sebagai media elektronik penyampaian pengaduan di mal pelayanan publik. Dengan adanya TEMAN BAIK ini diharapkan pengaduan-pengaduan yg ada di mal pelayanan publik dapat terkelola dengan baik sehingga masyarakat mendapatkan pelayanan yang prima dalam hal penyampaian pengaduan.
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            var captcha = false;

            window.onTurnstileSuccess = function(code) {
                captcha = true;
            }

            $('#buttonLogin').on('click', function(e) {
                e.preventDefault();
                if ($('#username').val() == "" && $('#password').val() == "") {
                    Swal.fire({
                        text: "Harap Isi Nama Pengguna atau Sandi Dengan Benar",
                        icon: "warning"
                    });
                } else {
                    if (!captcha) {
                        Swal.fire({
                            text: "Harap Selesaikan Captcha",
                            icon: "warning"
                        });
                    } else {
                        $('#loginForm').submit();
                    }
                }
            });
        </script>

    </body>

</html>
