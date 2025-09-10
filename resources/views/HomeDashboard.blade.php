@extends('dashboard/main')

@section('main')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Diterima</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $diterima }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-reply-all fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Dikirim</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dikirim }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dijawab</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dijawab }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="h5 text-black">
        Jumlah Permohonan Instansi
    </div>
    <table class="table table-striped">
        <tr class="border-left-secondary fw-bold table-primary text-white">
            <td>
                NAMA INSTANSI
            </td>
            <td>
                JUMLAH
            </td>
        </tr>
        @if (!$instansi->isEmpty())
            @foreach ($instansi as $ins)
                <tr class="border-left-secondary">
                    <td>
                        {{ $ins['nama_instansi'] }}
                    </td>
                    <td>
                        {{ $ins['pengaduan_count'] }}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="2" class="text-center"><i class="text-muted">
                        Tidak Ada Instansi
                    </i>
                </td>
            </tr>
        @endif
    </table>
@endsection
