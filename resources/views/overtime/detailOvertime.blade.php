@extends('_main/main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Payroll</li>
                        <li class="breadcrumb-item">Overtime</li>
                        <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3"><b>Tanggal Lembur</b></div>
                                            <div class="col-3">{{ $form->tanggalOT }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3"><b>Bagian</b></div>
                                            <div class="col-3"> {{ $form->bagian->namaBagian }}</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn btn-primary btn-block" id="btnCetak"><span
                                                        class="fas fa-print"></span>&nbsp;Print
                                                    Form Lembur</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-sm" id="dataProses">
                                <thead>
                                    <tr>
                                        <th style="width:5%">
                                            #
                                        </th>
                                        <th style="width:8%">
                                            NIK
                                        </th>
                                        <th style="width:15%">
                                            Nama Karyawan
                                        </th>
                                        <th style="width:8%">
                                            Jam Lembur
                                        </th>
                                        <th style="">
                                            jenis Pekerjaan
                                        </th>
                                        <th style="">
                                            Jadwal Masuk
                                        </th>
                                        <th style="">
                                            Jadwal Pulang
                                        </th>
                                        <th style="">
                                            Jam Masuk
                                        </th>
                                        <th style="">
                                            Jam Pulang
                                        </th>
                                        <th style="width: :5%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $abs = collect($absensi);
                                    @endphp
                                    @foreach ($data as $key => $d)
                                        @php
                                            $detailAbsensi = $abs->firstWhere('idKaryawan', $d->idKaryawan);
                                        @endphp
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $d->karyawan->nikKerja }}
                                            </td>
                                            <td>
                                                {{ $d->karyawan->namaKaryawan }}
                                            </td>
                                            <td>
                                                {{ $d->jam1 + $d->jam2 }} Jam
                                            </td>
                                            <td>
                                                {{ $d->jenisPekerjaan }}
                                            </td>
                                            <td>
                                                {{ $detailAbsensi['jadwalMasuk'] }}
                                            </td>
                                            <td>
                                                {{ $detailAbsensi['jadwalPulang'] }}
                                            </td>
                                            <td>
                                                {{ $detailAbsensi['jamDatang'] }}
                                            </td>
                                            <td>
                                                {{ $detailAbsensi['jamPulang'] }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary btn-xs" id="btnEdit"><i
                                                            class="far fa-edit"></i> Acc</button>
                                                    <button type="button" class="btn btn-danger btn-xs" id="btnDelete"><i
                                                            class="fas fa-trash-alt"></i> Cancel</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('btnCetak').onclick = () => {
            window.open("../cetakLaporan");
        }
    </script>
@endsection
