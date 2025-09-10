@extends('dashboard/main')

@section('main')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Manajemen Instansi</h1>
        <button type="button" class="btn btn-primary btn-sm d-block ml-auto" data-bs-toggle="modal" data-bs-target="#tambahInstansi">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;TAMBAH
        </button>
    </div>

    @if (session()->has('success'))
        <input type="hidden" id="notifSuccess" value="{{ session()->get('success') }}">
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="fw-bold">
                    <td scope="col">#</td>
                    <td scope="col">Nama Instansi</td>
                    <td scope="col">E-Mail 1</td>
                    <td scope="col">E-Mail 2</td>
                    <td scope="col">E-Mail 3</td>
                    <td scope="col">No. Whatsapp</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @if (!$instansi->isEmpty())
                    @foreach ($instansi as $in)
                        <tr>
                            <td scope="col">{{ $loop->iteration }}</td>
                            <td scope="col" class="t_nama_instansi">{{ $in->nama_instansi }}</td>
                            <td scope="col">{{ $in->email1 }}</td>
                            <td scope="col">{{ $in->email2 }}</td>
                            <td scope="col">{{ $in->email3 }}</td>
                            <td scope="col"><a href="https://wa.me/62{{ substr($in->no_wa1, 1) }}" target="_blank">
                                    {{ $in->no_wa1 }}
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm px-2 buttonEditInstansi" data-id={{ $in->id }}>
                                    <i class="far fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm px-2 buttonDeleteInstansi" data-id={{ $in->id }}>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center"><i class="text-muted">
                                Tidak Ada Data
                            </i>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Instansi -->
    <div class="modal fade" id="tambahInstansi" tabindex="-1" aria-labelledby="tambahInstansiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/manajemen-instansi" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahInstansiLabel">Tambah Instansi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaInstansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control" id="namaInstansi" name="nama_instansi" required>
                        </div>
                        <div class="mb-3">
                            <label for="email1" class="form-label">E-Mail 1</label>
                            <input type="email" class="form-control" id="email1" name="email1" required>
                        </div>
                        <div class="mb-3">
                            <label for="email2" class="form-label">E-Mail 2</label>
                            <input type="email" class="form-control" id="email2" name="email2" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email3" class="form-label">E-Mail 3</label>
                            <input type="email" class="form-control" id="email3" name="email3" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa1" class="form-label">Nomor Whatsapp</label>
                            <input type="text" class="form-control" id="no_wa1" name="no_wa1" onkeypress="onlyNumber(event)" placeholder="08xxxxxxxx" pattern="(08)(\d{5,11})" maxlength="13" minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editInstansi" tabindex="-1" aria-labelledby="editInstansiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="formEditInstansi">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id_ins" value="">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editInstansiLabel">Edit Instansi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editNamaInstansi" class="form-label">Nama Instansi</label>
                            <input type="text" class="form-control" id="editNamaInstansi" name="editNamaInstansi" required>
                        </div>
                        <div class="mb-3">
                            <label for="Editemail1" class="form-label">E-Mail 1</label>
                            <input type="email" class="form-control" id="Editemail1" name="Editemail1" required>
                        </div>
                        <div class="mb-3">
                            <label for="Editemail2" class="form-label">E-Mail 2</label>
                            <input type="email" class="form-control" id="Editemail2" name="Editemail2">
                        </div>
                        <div class="mb-3">
                            <label for="Editemail3" class="form-label">E-Mail 3</label>
                            <input type="email" class="form-control" id="Editemail3" name="Editemail3">
                        </div>
                        <div class="mb-3">
                            <label for="Editno_wa1" class="form-label">Nomor Whatsapp</label>
                            <input type="text" class="form-control" id="Editno_wa1" name="Editno_wa1" onkeypress="onlyNumber(event)" placeholder="08xxxxxxxx" pattern="(08)(\d{5,11})" maxlength="13" minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
