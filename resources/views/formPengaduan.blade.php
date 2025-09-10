<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <title>Form Pengaduan - TEMAN BAIK</title>
    </head>

    <body>
        @if (session()->has('success'))
            <input type="hidden" id="notifSuccess">
        @endif
        <div class="min-vh-100 bg-primary bg-gradient py-0 py-md-2 py-lg-4">
            <div class="container card">
                <div class="row">
                    <div class="col">
                        <a href="/" style="width: 150px" class="mx-auto">
                            <img src="img/tb.png" alt="" width="150px" class="my-3 d-block mx-auto" style="filter: brightness(0) saturate(100%) invert(30%) sepia(51%) saturate(5320%) hue-rotate(210deg) brightness(102%) contrast(98%);">
                        </a>
                    </div>
                    <div class="col">
                        <div class="text-center fs-3 fw-bold d-flex h-100 justify-content-center align-items-center text-primary">FORM PERMOHONAN</div>
                    </div>
                    <div class="col d-none d-md-block"></div>
                </div>
                <hr class="mt-0">
                <form action="/pengaduan" method="POST" id="formAduan" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="penginput" value="mandiri">
                    <div class="row">
                        <div class="col-md-6 border-end">
                            <div class="mb-3">
                                <div class="form-label">Jenis Permohonan</div>
                                <div class="form-check form-check-inline me-5">
                                    <input class="form-check-input" type="radio" name="jenisAduan" id="jenisAduan1" value=1>
                                    <label class="form-check-label" for="jenisAduan1">
                                        PENGADUAN
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisAduan" id="jenisAduan2" value=0 checked>
                                    <label class="form-check-label" for="jenisAduan2">
                                        INFORMASI
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="instansi" class="form-label">Instansi yang ditanyakan</label>
                                <select class="form-select req" name="instansi" id="instansi" required>
                                    <option value="" selected>Pilih Instansi...</option>
                                    @foreach ($instansi as $i)
                                        <option value="{{ $i->id }}">{{ $i->nama_instansi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control req" id="nama" name="nama" required title="harap isi nama" onkeypress="onlyAlpha()">
                            </div>
                            <div class="mb-3">
                                <label for="nohp" class="form-label">No. Hp (Whatsapp)</label>
                                <button type="button" class="p-0 btn btn-link text-decoration-none float-end" onclick="cekNomor()">cek nomor</button>
                                <input type="tel" class="form-control req" id="nohp" name="nohp" pattern="(08)(\d{5,11})" required placeholder="08xxxxxxx" maxlength="13" minlength="6" title="isi sesuai format" onkeypress="onlyNumber(event)">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control req" id="alamat" name="alamat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 mb-md-5">
                                <label for="isi_aduan" class="form-label">Isi Pertanyaan</label>
                                <textarea type="text" class="form-control req" id="isi_aduan" name="isi_aduan" required style="height: 112px"></textarea>
                            </div>
                            <div class="input-group">
                                <label class="input-group-text" for="bukti">Bukti Dukung</label>
                                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/png, image/jpeg, application/pdf" required>
                            </div>
                            <div class="small fst-italic text-end mb-3 mb-md-0">
                                format .jpg, .png, .pdf - Maks. 3MB
                            </div>
                            <div class="text-start ps-1">
                                Banjarmasin, {{ date('d F Y') }}
                            </div>
                            <div class="w-100 position-relative wrapper-sign" style="height: 130px">
                                <div class="position-absolute">
                                    &nbsp;Tanda Tangan,
                                </div>
                                <canvas id="signature-pad" class="position-absolute signature-pad end-0 border border-primary-subtle rounded-3" width="100%" height="100%"></canvas>
                                <button type="button" id="clear" class="position-absolute end-0 bottom-0 rounded-3">hapus</button>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 border-end">
                            <div class="mb-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 id="samarkan" name="samarkan" checked>
                                    <label class="form-check-label fw-bold" for="samarkan">
                                        SAMARKAN IDENTITAS
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-size="flexible" data-theme="light" data-callback="onTurnstileSuccess"></div>
                        </div>
                    </div>
                    <input type="hidden" name="ttd" id="ttd">
                    <button type="submit" class="w-100 btn btn-lg btn-primary mb-3 fw-bold" id="kirimAduan" disabled>KIRIM</button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            var canvas = document.getElementById('signature-pad');
            var parentWidth = $(canvas).parent().outerWidth();
            var parentHeight = $(canvas).parent().outerHeight();

            canvas.setAttribute("width", parentWidth);
            canvas.setAttribute("height", parentHeight);

            this.signaturePad = new SignaturePad(canvas);

            var dwidth = $(window).width();

            function resizeCanvas() {
                var wwidth = $(window).width();
                if (dwidth !== wwidth) {
                    canvas.width = $(canvas).parent().outerWidth();
                    signaturePad.clear();
                }
            }

            function cekNomor() {
                if ($('#nohp').val() == '') {
                    alert('harap isi nomor Whatsapp anda');
                } else {
                    var url = 'https://wa.me/62' + $('#nohp').val().substring(1);
                    window.open(url, '_blank');
                }
            }

            window.addEventListener("resize", resizeCanvas);

            var cancelButton = document.getElementById('clear');

            function onlyNumber(evt) {
                var theEvent = evt || window.event;

                // Handle paste
                if (theEvent.type === 'paste') {
                    key = event.clipboardData.getData('text/plain');
                } else {
                    // Handle key press
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode(key);
                }
                var regex = /[0-9]|\./;
                if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault) theEvent.preventDefault();
                }
            }

            function onlyAlpha(evt) {
                var theEvent = evt || window.event;

                // Handle paste
                if (theEvent.type === 'paste') {
                    key = event.clipboardData.getData('text/plain');
                } else {
                    // Handle key press
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode(key);
                }
                var regex = /[a-z A-Z]|\./;
                if (!regex.test(key)) {
                    theEvent.returnValue = false;
                    if (theEvent.preventDefault) theEvent.preventDefault();
                }
            }


            $('#jenisAduan1, #jenisAduan2').on('click', function() {
                if ($('#jenisAduan1').prop("checked")) {
                    $("label[for='instansi']").text("Instansi yang Diadukan");
                    $("label[for='isi_aduan']").text("Isi Aduan");
                } else {
                    $("label[for='instansi']").text("Instansi yang Ditanyakan");
                    $("label[for='isi_aduan']").text("Isi Pertanyaan");
                }
            });

            var captcha = false;

            window.onTurnstileSuccess = function(code) {
                captcha = true;
            }

            var empty = true;

            function cekInput() {
                if ($('#instansi').val() != '' &&
                    $('#nama').val() != '' &&
                    $('#nohp').val() != '' &&
                    $('#alamat').val() != '' &&
                    $('#isi_aduan').val() != '' &&
                    !signaturePad.isEmpty()) {
                    empty = false;
                } else {
                    empty = true;
                }

                if (empty) {
                    $('#kirimAduan').attr('disabled', 'disabled');
                } else {
                    $('#kirimAduan').removeAttr('disabled');
                }
            }

            $('.req').on('keypress keydown keyup change', function() {
                cekInput();
            });

            cancelButton.addEventListener('click', function(event) {
                signaturePad.clear();
            });

            signaturePad.addEventListener("endStroke", () => {
                cekInput();
            }, {
                once: true
            });

            signaturePad.addEventListener("afterUpdateStroke", () => {
                cekInput();
            }, {
                once: true
            });

            $('#kirimAduan').on('click', function(e) {
                e.preventDefault();
                if (signaturePad.isEmpty()) {
                    Swal.fire({
                        text: "Harap Tanda Tangani Form Pengaduan Anda",
                        icon: "warning"
                    });
                } else {
                    if (captcha) {
                        Swal.fire({
                            title: "Yakin Ingin Mengirim Aduan ?",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;",
                            cancelButtonText: "Batal",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#ttd').val(signaturePad.toDataURL('image/png'));
                                $('#formAduan').submit();
                                Swal.fire({
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    title: "mengirim...",
                                    html: '<div class="spinner-border text-primary m-2" role="status"><span class="visually-hidden">Loading...</span></div>'
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            text: "Harap Selesaikan Captcha",
                            icon: "warning"
                        });
                    }
                }
            });

            if ($('#notifSuccess') && $('#notifSuccess').length) {
                Swal.fire({
                    title: "Pengaduan Berhasil Dikirim",
                    icon: "success",
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        </script>
    </body>

</html>
