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
                        <li class="breadcrumb-item">Data Karyawan</li>
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
                            <h5 class="m-0">{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex  justify-content-end">
                                <a href="{{ URL::to('/') }}/dk/karyawan/addData" class="btn-sm btn-primary"><i
                                        class="fa fa-plus"></i>
                                    Add Data</a>
                            </div>
                            <div class="mt-3">
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIK</th>
                                            <th>Nama Karyawn</th>
                                            <th>Jabatan</th>
                                            <th>Dept. / Bagian</th>
                                            <th>Tanggal Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="2">1.</td>
                                            <td>1111504021</td>
                                            <td>Nopebri Ade Candra</td>
                                            <td>STF</td>
                                            <td>GA / IT</td>
                                            <td>01-04-2015</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1">Finger ID : 6</td>
                                            <td colspan="1">Kode Jam Kerja : STF1</td>
                                            <td colspan="1">STatus : Tetap</td>
                                            <td colspan="2" style="text-align: right">Perusahaan : <i>PT Lion Metal Works
                                                    Tbk</i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
