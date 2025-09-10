<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <title>TEMAN BAIK</title>

        <style>
            .ocean {
                height: 5%;
                width: 100%;
                position: absolute;
                bottom: 0;
                left: 0;
                background: #0a6dfc;
            }

            .wave {
                /* background: url('img/wave.svg') repeat-x; */
                background: url('img/wave.svg') repeat-x;
                position: absolute;
                top: -272px;
                width: 6400px;
                height: 272px;
                animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
                transform: translate3d(0, 0, 0);
                filter: brightness(0) saturate(100%) invert(24%) sepia(99%) saturate(2157%) hue-rotate(210deg) brightness(105%) contrast(98%);
            }

            .wave:nth-of-type(2) {
                top: -255px;
                animation: wave 5s cubic-bezier(0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 6.9s ease -1.25s infinite;
                opacity: 1;
            }

            @keyframes wave {
                0% {
                    margin-left: 0;
                }

                100% {
                    margin-left: -1600px;
                }
            }

            @keyframes swell {

                0%,
                100% {
                    transform: translate3d(0, -25px, 0);
                }

                50% {
                    transform: translate3d(0, 5px, 0);
                }
            }
        </style>
    </head>

    <body>
        <div class="vw-100 min-vh-100 d-flex flex-column position-relative overflow-hidden">
            <div class="container-fluid">
                <nav class="navbar bg-white">
                    <a href="/login" class="btn px-4 rounded-pill btn-outline-primary ms-auto py-1">login</a>
                </nav>
            </div>
            <div class="container mt-5 flex-grow-1">
                <div class="row pt-md-5 align-items-center">
                    <div class="col-lg-6 mb-4">
                        <div style="text-align: justify">
                            <span class="h4 text-primary">
                                TEMAN BAIK
                            </span>
                            <span class="h5">
                                merupakan akronim dari <b class="text-primary">Tem</b>pat penyampai<b class="text-primary">an</b> <b class="text-primary">B</b>erbagai <b class="text-primary">a</b>duan di Mal Pelayanan publ<b class="text-primary">ik</b>.<br>
                            </span>
                            <div class="mb-3 mt-2">
                                Meningkatkan efektivitas dan efisiensi dalam menangani permohonan informasi dan pengaduan masyarakat. Diharapkan dapat tercipta koordinasi yang lebih baik antara berbagai instansi yang tergabung dalam Mal Pelayanan Publik Kota Banjarmasin
                            </div>
                        </div>
                        <a href="/form" class="btn px-4 rounded-pill btn-outline-primary ms-auto py-1">Sampaikan Permohonan Informasi / Aduan</a>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center order-first order-lg-last mb-5">
                        <img src="/img/tb.gif" class="w-50 mx-auto" alt="">
                    </div>
                </div>
            </div>
            <div class="w-100 position-relative" style="height: 280px">
                <div class="ocean">
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
            <div class="position-absolute w-100 bottom-0">
                <div class="container-fluid">
                    <div class="row pb-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="https://instagram.com/mpp.banjarmasin" class="text-white text-decoration-none" target="_blank">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd" />
                                        </svg>
                                        mpp.banjarmasin
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="https://mpp.banjarmasinkota.go.id" class="text-white text-decoration-none" target="_blank">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.37 7.657c2.063.528 2.396 2.806 3.202 3.87 1.07 1.413 2.075 1.228 3.192 2.644 1.805 2.289 1.312 5.705 1.312 6.705M20 15h-1a4 4 0 0 0-4 4v1M8.587 3.992c0 .822.112 1.886 1.515 2.58 1.402.693 2.918.351 2.918 2.334 0 .276 0 2.008 1.972 2.008 2.026.031 2.026-1.678 2.026-2.008 0-.65.527-.9 1.177-.9H20M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        mpp.banjarmasinkota.go.id
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center text-lg-end text-white mt-3 mt-lg-0">
                                &copy; DPMPTSP Kota Banjarmasin
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>

</html>
