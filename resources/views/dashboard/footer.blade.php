<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; DPMPTSP</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

{{-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}


<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha512-ahmSZKApTDNd3gVuqL5TQ3MBTj8tL5p2tYV05Xxzcfu6/ecvt1A0j6tfudSGBVuteSoTRMqMljbfdU0g2eDNUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Custom scripts for all pages-->
<script src="vendor/js/sb-admin-2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    var validMailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    $('#email1').on('input', function() {
        var email1 = this.value;
        if (email1.match(validMailRegex)) {
            $('#email2').prop("disabled", false);
            $('#email2').on('input', function() {
                var email2 = this.value;
                if (email2.match(validMailRegex)) {
                    $('#email3').prop("disabled", false);

                } else {
                    $('#email3').prop("disabled", true);
                }
            });
        } else {
            $('#email2').prop("disabled", true);
            $('#email3').prop("disabled", true);
        }
    });

    $('#jenisAduan1, #jenisAduan2').on('click', function() {
        if ($('#jenisAduan1').prop("checked")) {
            $("label[for='instansi']").text("Instansi yang Diadukan");
            $("label[for='isi_aduan']").text("Isi Aduan");
        } else {
            $("label[for='instansi']").text("Instansi yang Ditanyakan");
            $("label[for='isi_aduan']").text("Isi Pertanyaan");
        }
    });

    function cekNomor() {
        if ($('#nohp').val() == '') {
            alert('harap isi nomor Whatsapp anda');
        } else {
            var url = 'https://wa.me/62' + $('#nohp').val().substring(1);
            window.open(url, '_blank');
        }
    }

    $('.buttonEditInstansi').on('click', function() {
        const editInstansiModal = new bootstrap.Modal('#editInstansi', {
            keyboard: false
        });
        $.get('manajemen-instansi/' + $(this).data('id') + '/edit', function(data) {
            $('#formEditInstansi').attr('action', '/manajemen-instansi/' + data.id);
            $('#editNamaInstansi').val(data.nama_instansi);
            $('#id_ins').val(data.id);
            $('#Editemail1').val(data.email1);
            $('#Editemail2').val(data.email2);
            $('#Editemail3').val(data.email3);
            $('#Editno_wa1').val(data.no_wa1);
        });
        editInstansiModal.show();
    });

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

    $('.buttonDeleteInstansi').on('click', function() {
        let ins_id = $(this).data('id');
        let ins_nama = $(this).parent().siblings('.t_nama_instansi').text();
        Swal.fire({
            html: "Hapus Instansi<br><b>" + ins_nama + "</b>",
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/manajemen-instansi/' + ins_id,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            type: 'success',
                            icon: response.icon,
                            title: response.message,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 3000
                        }).then(() => {
                            location.reload(true)
                        });
                    }
                });
            }
        })
    });

    if ($('#editIntansi').length) {
        const editInstansiModal1 = document.getElementById('editInstansi');
        editInstansiModal1.addEventListener('hidden.bs.modal', event => {
            $('#formEditInstansi').attr('action', '');
            $('#editNamaInstansi').val('');
            $('#id_ins').val('');
            $('#Editemail1').val('');
            $('#Editemail2').val('');
            $('#Editemail3').val('');
            $('#Editno_wa1').val('');
        });
    }

    $('.editButton').on('click', function() {
        var idAduan = $(this).data('id-aduan');
        const editModal = new bootstrap.Modal('#editModal', {
            keyboard: false
        });

        $.get('getDataAduan/' + idAduan, function(data) {
            var tgl_aduan = data.tgl_aduan.split("-").reverse().join("-");
            $('#data_tgl_aduan').val(tgl_aduan);
            const instansi = data.list_instansi;
            var optionInstansi = '<option value="">Choose...</option>';
            instansi.forEach(element => {
                var selected = '';
                if (data.instansi) {
                    if (element.id == data.instansi.id) {
                        selected = 'selected';
                    }
                }
                optionInstansi = optionInstansi + '<option value="' + element.id + '" ' + selected + '>' + element.nama_instansi + '</option>';
            });

            var list_instansi = '<select class="form-select" name="data_instansi" id="data_instansi">' + optionInstansi + '</select>';
            $('#list_instansi').html(list_instansi);

            $('#data_id_aduan').val(data.id);
            $('#data_nama').val(data.nama);
            $('#data_nohp').val(data.telepon);
            $('#data_alamat').val(data.alamat);
            $('#data_isi_aduan').val(data.aduan);
            $('#data_jawaban').val(data.jawaban);
            $('#buttonAksiAduan').html('');
            if (data.nama_file_eviden) {
                $('#docBuktiDukung').html('<div class="d-none d-md-block">&nbsp;</div><a class="fw-bold btn btn-outline-success w-100 mb-3" target="_blank" href="/storage/eviden/' + data.nama_file_eviden + '"><i class="far fa-file-alt"></i> Lihat Bukti Dukung</a>');
            }

            if (data.penginput == "admin") {
                $('#docBukti').html('<a class="fw-bold btn btn-outline-primary w-100" target="_blank" href="/storage/doc/' + data.nama_file + '"><i class="far fa-file-alt"></i> Lihat Kertas Aduan</a>');
            } else if (data.penginput == "mandiri") {
                $('#docBukti').html('ttd,<img src="/storage/doc/' + data.nama_file + '" width=100%></img>');
            }
            if (data.id_status == 1) {
                $('#formActionAduan').attr('action', '/teruskan-aduan');
                $('#buttonAksiAduan').html('<div class="col"><button class="btn btn-warning w-100 h-100" type="button" id="buttonTeruskan" onclick="teruskan()">Teruskan ke Instansi Terkait</button></div>')
            } else if (data.id_status == 2) {
                $('#formActionAduan').attr('action', '/teruskan-aduan');
                $('#buttonAksiAduan').html('<div class="col"><button class="btn btn-warning w-100 h-100" type="button" id="buttonTeruskan" onclick="teruskan()">Teruskan Ulang</button></div> <div class="col"><button type="button" class="btn btn-success w-100 h-100" onclick="jawabAduan()">Jawab Aduan</button></div>')
            } else if (data.id_status == 3) {
                $('#buttonAksiAduan').html('<div class="col"><button type="button" class="btn btn-success w-100" id="buttonJawabAduan" onclick="jawabAduan()">Lihat Jawaban</button></div>')
            }
            editModal.show();
        });
    });

    function teruskan() {
        if ($("#data_instansi").val() == "") {
            Swal.fire({
                title: "Harap pilih instansi",
                icon: "warning"
            });
        } else {
            Swal.fire({
                title: "Yakin Ingin Meneruskan Aduan ?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    sendLoading("mengirim...");
                    $('#formActionAduan').submit();
                }
            });
        }
    };

    function jawabAduan() {
        Swal.fire({
            input: "textarea",
            inputLabel: "Jawab Aduan",
            inputPlaceholder: "Ketik Jawaban Anda...",
            inputAttributes: {
                "aria-label": "Ketik Jawaban Anda"
            },
            inputValue: $('#data_jawaban').val(),
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Simpan & Kirim",
            preConfirm: () => {
                if ($('#swal2-textarea').val() == '') {
                    alert('Harap Isi Jawaban');
                    return false;
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value) {
                    let nohp = '62' + $('#data_nohp').val().substring(1);
                    let nama_pengadu = $('#data_nama').val();
                    if ($('#data_instansi option:selected').val() == '') {
                        var nama_instansi_send = '';
                    } else {
                        var nama_instansi_send = 'ke ' + $('#data_instansi option:selected').text();
                    }
                    let tgl_aduan = $('#data_tgl_aduan').val()
                    let jawaban_aduan = encodeURI(result.value);
                    sendLoading('mengirim...');

                    $.ajax({
                        url: "/pengaduan/" + $('#data_id_aduan').val(),
                        type: "PUT",
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            "jawaban": result.value,
                        },
                        success: function(response) {
                            const res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire({
                                    title: "Jawaban Berhasil Dikirim",
                                    icon: "success",
                                    timer: 3000,
                                    timerProgressBar: true,
                                }).then(() => {
                                    //location.reload(true);
                                    Swal.close();
                                });
                            } else {
                                Swal.fire({
                                    title: "Jawaban Gagal Dikirim",
                                    icon: "error",
                                    text: res.message,
                                    timer: 3000,
                                    timerProgressBar: true,
                                }).then(() => {
                                    //location.reload(true);
                                    Swal.close();
                                });
                            }
                        }
                    });
                } else {
                    alert('Harap Isi Jawaban');
                }
            }
        });
    }

    if ($('#notifSuccessSend') && $('#notifSuccessSend').length) {
        var htmlbody = '<i class="far fa-check-circle text-success"></i> E-Mail Berhasil Dikirim<br>';
        if ($('#notifSuccessSend').data('wa-status')) {
            htmlbody += '<i class="far fa-check-circle text-success"></i> Whatsapp Berhasil Dikirim';
        } else {
            htmlbody += '<i class="far fa-times-circle text-danger"></i> Whatsapp Gagal Dikirim (' + $('#notifSuccessSend').data('wa-massage') + ')';
        }
        Swal.fire({
            icon: "success",
            timer: 5000,
            html: htmlbody,
            timerProgressBar: true,
        });
    }

    if ($('#notifSuccess') && $('#notifSuccess').length) {
        console.log($('#notifSuccess').val());
        Swal.fire({
            title: $('#notifSuccess').val(),
            icon: "success",
            timer: 5000,
            timerProgressBar: true,
        });
    }


    $('#kirimAduanAdmin').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Yakin Ingin Mengirim Aduan ?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "&nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp;",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formAduanAdmin').submit();
            }
        });
    });

    function sendLoading($title = "loading") {
        Swal.fire({
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            title: $title,
            html: '<div class="spinner-border text-primary m-2" role="status"><span class="visually-hidden">Loading...</span></div>'
        });
    }
</script>

</body>

</html>
