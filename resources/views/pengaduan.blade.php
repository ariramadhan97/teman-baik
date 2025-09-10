@extends('dashboard/main')

@section('main')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaduan</h1>
        <a href="/download" type="button" class="btn btn-success btn-sm d-block ml-auto">
            <i class="fas fa-file-download"></i>&nbsp;&nbsp;UNDUH DATA
        </a>
        <button type="button" class="btn btn-primary btn-sm d-block ml-sm-2 mt-2 mt-sm-0" data-bs-toggle="modal" data-bs-target="#inputPengaduan">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;INPUT
        </button>
    </div>

    @if (session()->has('success'))
        <input type="hidden" id="notifSuccessSend" data-wa-status="{{ session('success')->success }}" data-wa-massage="{{ session('success')->message }}">
    @endif

    @if (!$aduan->isEmpty())
        <div class="row mb-2">
            <div class="col-auto mb-2">Ket. :</div>
            <div class="col-auto text-black mb-2">
                <span class="bg-warning-subtle py-1 px-3 rounded-5"><i class="fas fa-exclamation text-black"></i> &nbsp; Pengaduan </span>
            </div>
            <div class="col-auto text-black mb-2">
                <span class="bg-info py-1 px-3 rounded-5"><i class="fas fa-question text-black"></i> &nbsp; Informasi </span>
            </div>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="fw-bold">
                    <td scope="col"></td>
                    <td scope="col">#</td>
                    <td scope="col">Status</td>
                    <td scope="col">Tanggal Permohonan</td>
                    <td>Instansi yang Dituju</td>
                    <td scope="col">Nama</td>
                    <td scope="col">Alamat</td>
                    <td scope="col">Nomor HP</td>
                    <td scope="col">Isi Permohonan</td>
                    <td scope="col">Penginput</td>
                    <td scope="col">Samarkan Identitas</td>
                    <td scope="col">#</td>
                </tr>
            </thead>
            <tbody>
                @if (!$aduan->isEmpty())
                    @foreach ($aduan as $ad)
                        <tr class="@if ($ad->is_aduan) table-warning @else table-info @endif">
                            @if ($ad->is_aduan)
                                <td>
                                    <i class="fas fa-exclamation"></i>
                                </td>
                            @else
                                <td>
                                    <i class="fas fa-question"></i>
                                </td>
                            @endif
                            <td scope="col">{{ $aduan->firstItem() + $loop->index }}</td>
                            <td scope="col">
                                <div class="@if ($ad->status->id == 1) bg-primary text-white @elseif($ad->status->id == 2) bg-warning @elseif($ad->status->id == 3) bg-success @endif rounded-pill px-2 text-center">
                                    {{ $ad->status->status }}
                                </div>
                            </td>
                            <td scope="col">{{ date_format(date_create($ad['tgl_aduan']), 'd/m/Y') }}</td>
                            <td>
                                @if ($ad->instansi)
                                    {{ $ad->instansi->nama_instansi }}
                                @else
                                    <i>(Instansi dihapus dari sistem)</i>
                                @endif
                            </td>
                            <td scope="col">{{ $ad['nama'] }}</td>
                            <td scope="col">{{ $ad['alamat'] }}</td>
                            <td scope="col">
                                <a href="https://wa.me/62{{ substr($ad['telepon'], 1) }}" target="_blank">
                                    {{ $ad['telepon'] }}
                                </a>
                            </td>
                            <td scope="col">{!! nl2br($ad['aduan']) !!}</td>
                            <td scope="col">{{ $ad['penginput'] }}</td>
                            <td scope="col">
                                @if ($ad->samarkan)
                                    Ya
                                @else
                                    Tidak
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger editButton" class="btn btn-primary" data-id-aduan={{ $ad['id'] }}>
                                    <i class="far fa-share-square"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-center"><i class="text-muted">
                                Tidak Ada Data
                            </i>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{ $aduan->links() }}

    <div class="modal fade" id="inputPengaduan" tabindex="-1" aria-labelledby="inputPengaduanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="/pengaduan" method="POST" enctype="multipart/form-data" id="formAduanAdmin">
                    @csrf
                    <input type="hidden" name="penginput" value="admin">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="inputPengaduanLabel">Input Permohonan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label" style="margin-bottom: 12px">Jenis Permohonan</div>
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
                                    <div class="mb-2">
                                        <label for="tgl_aduan" class="form-label">Tanggal Permohonan</label>
                                        <input type="date" class="form-control" id="tgl_aduan" name="tgl_aduan" max="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="instansi" class="form-label">Instansi yang Ditanyakan</label>
                                        <select class="form-select" name="instansi" id="instansi">
                                            <option selected>Choose...</option>
                                            @foreach ($instansi as $i)
                                                <option value="{{ $i->id }}">{{ $i->nama_instansi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="nohp" class="form-label">No. Hp (Whatsapp)</label>
                                        <button type="button" class="p-0 btn btn-link text-decoration-none float-end" onclick="cekNomor()">cek nomor</button>
                                        <input type="tel" pattern="[0-9]{1}[8]{1}-[0-9]{7-11}" class="form-control" id="nohp" name="nohp" required placeholder="08xxxxxxx">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="isi_aduan" class="form-label">Isi Pertanyaan</label>
                                        <textarea type="text" class="form-control" id="isi_aduan" name="isi_aduan" required></textarea>
                                    </div>
                                    <div class="input-group mb-1">
                                        <label class="input-group-text" for="bukti">Bukti Dukung</label>
                                        <input type="file" class="form-control" id="bukti" name="bukti" accept="image/png, image/jpeg">
                                    </div>
                                    <div class="small fst-italic text-end mb-3">
                                        format .jpg, .png, .pdf - maks. 3MB
                                    </div>
                                    <div class="input-group mb-1">
                                        <label class="input-group-text" for="kertas">Kertas Aduan</label>
                                        <input type="file" class="form-control" id="kertas" name="kertas" accept="image/png, image/jpeg" required>
                                    </div>
                                    <div class="small fst-italic text-end">
                                        format foto (.jpg, .png) - maks. 3MB
                                    </div>
                                    <div class="mb-3 mt-4 ps-1">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=1 id="samarkan" name="samarkan" checked>
                                            <label class="form-check-label fw-bold" for="samarkan">
                                                SAMARKAN IDENTITAS
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="kirimAduanAdmin">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="formActionAduan">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Data Pengaduan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="data_id_aduan" id="data_id_aduan">
                                    <input type="hidden" name="data_jawaban" id="data_jawaban">
                                    <div class="mb-2">
                                        <label for="data_tgl_aduan" class="form-label">Tanggal Aduan</label>
                                        <input type="text" class="form-control" id="data_tgl_aduan" name="data_tgl_aduan" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label for="data_instansi" class="form-label">Instansi yang diadukan</label>
                                        <div id="list_instansi">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="data_nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="data_nama" name="data_nama" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label for="data_nohp" class="form-label">No. Hp (Whatsapp)</label>
                                        <input type="text" class="form-control" id="data_nohp" name="data_nohp" readonly placeholder="08xxxxxxx">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="data_alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="data_alamat" name="data_alamat" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data_isi_aduan" class="form-label">Isi Aduan</label>
                                        <textarea type="text" class="form-control" id="data_isi_aduan" name="data_isi_aduan" readonly style="height: 115px"></textarea>
                                    </div>
                                    <div id="docBuktiDukung"></div>
                                    <div id="docBukti"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid">
                            <div class="row" id="buttonAksiAduan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
