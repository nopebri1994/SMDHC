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

            <ul class="nav nav-tabs" id="group" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="umum-tab" data-toggle="tab" href="#umum" role="tab"
                        aria-controls="groupOffA" aria-selected="true">Data Umum</a>
                </li>

                @can('payroll')
                    <li class="nav-item">
                        <a class="nav-link" id="tunjangan-tab" data-toggle="tab" href="#tunjangan" role="tab"
                            aria-controls="groupOffB" aria-selected="true">Tunjangan</a>
                    </li>
                @endcan
            </ul>

            <div class="tab-content" id="myTabGroup">
                <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row mt-3">
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
                <div class="tab-pane fade show" id="tunjangan" role="tabpanel" aria-labelledby="tunjangan-tab">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Tunjangan / Salary Karyawan
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Gaji Pokok
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                UMP
                                            </div>
                                            <div class="col-md-5">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Transport
                                            </div>
                                            <div class="col-md-5">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Transport 1
                                            </div>
                                            <div class="col-md-5">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Makan
                                            </div>
                                            <div class="col-md-5">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Tj. Jabatan
                                            </div>
                                            <div class="col-md-5">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Tj. Shift
                                            </div>
                                            <div class="col-md-5">

                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Pot. SPSI
                                            </div>
                                            <div class="col-md-5">

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
    </div>
@endsection
@section('js')
    <script></script>
@endsection
