@extends('_main/main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Karyawan</li>
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Daftar Karyawan</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <a href="{{ URL::to('/') }}/dk/karyawan" class="btn btn-danger"><i
                                        class="fas fa-backward"></i>
                                    Back</a>
                                @can('hc')
                                    <a href="{{ URL::to('/') }}/dk/karyawan/edit-data/{{ $detailData->uuid }}"
                                        class="btn btn-success"><i class="fas fa-update"></i> Edit Data
                                        Karyawan</a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Nomor Induk Kerja (NIK)
                                        </div>
                                        <div class="col-md-4">
                                            {{ $detailData->nikKerja }}
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Nama Karyawan
                                        </div>
                                        <div class="col-md-8">
                                            {{ $detailData->namaKaryawan }}
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Jenis Kelamin
                                        </div>
                                        <div class="col-md-3">
                                            {{ varHelper::varJK($detailData->jenisKelamin) }}
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Tanggal Masuk
                                        </div>
                                        <div class="col-md-5">
                                            {{ varHelper::formatDate($detailData->tglMasuk) }}
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Email
                                        </div>
                                        <div class="col-md-5">
                                            {{ $detailData->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="m-0"></h5>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Finger Print ID
                                        </div>
                                        <div class="col-md-4">
                                            {{ $detailData->fpId }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Perusahaan
                                        </div>
                                        <div class="col-md-6">
                                            {{ $detailData->perusahaan->namaPerusahaan }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Departemen
                                        </div>
                                        <div class="col-md-5">
                                            {{ $detailData->departemen->namaDepartemen }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Bagian
                                        </div>
                                        <div class="col-md-7">
                                            {{ $detailData->bagian->namaBagian }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Status Karyawan
                                        </div>
                                        <div class="col-md-4">
                                            {{ varHelper::varStatusKaryawan($detailData->statusKaryawan) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Jabatan
                                        </div>
                                        <div class="col-md-8">
                                            {{ $detailData->jabatan->namaJabatan }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Kode Jam Kerja
                                        </div>
                                        <div class="col-md-3">
                                            {{ $detailData->jamKerja->kodeJamKerja }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Group Off
                                        </div>
                                        <div class="col-md-3">
                                            @switch($detailData->groupOff)
                                                @case('A')
                                                    Group Off A
                                                @break

                                                @case('B')
                                                    Group Off B
                                                @break

                                                @default
                                                    Non Group Off
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            Group Kerja
                                        </div>
                                        <div class="col-md-3">
                                            @if ($detailData->groupKerja->groupKerja)
                                                {{ $detailData->groupKerja->groupKerja }}
                                            @else
                                                Non Group
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script></script>
@endsection
