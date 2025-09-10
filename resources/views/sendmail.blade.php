<!DOCTYPE html>
<html>

    <head>
        <title>Teman Baik</title>
    </head>

    <body>
        <h4>Kepada Yth. <br>
            {{ $data['instansi']->nama_instansi }}

            <p>
                {{ $data['aduan'] }}
            </p>
            Banjarmasin, {{ date_format(date_create($data['tgl_aduan']), 'd F Y') }} <br>
            ttd, <br>
            <br>
            {!! $data['ttd'] !!}
            <br>
            {!! $data['nama'] !!}
            <br>
            <br>
            {!! $data['bukti_dukung'] !!}
        </h4>
        <hr>
        <small>Pengaduan ini dikirim melalui {{ $data['penginput'] }} di sistem aplikasi TEMAN BAIK</small><br>
        <small><b>Mohon balas pesan ini jika anda memiliki jawaban terhadap aduan yang diberikan</b></small>
    </body>

</html>
