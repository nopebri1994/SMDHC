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
                            <div class="row">
                                <div class="col-md-1 pt-2">
                                    <label for="tglAwal">Periode</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="tglAwal" id="tglAwal" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="tglkhir" id="tglAkhir" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary btn sm" id="btnView">
                                        <span class="fas fa-table"></span>&nbsp;Lihat Data</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="tglLembur">Tanggal Lembur</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date" name="tglLembur" id="tglLembur" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-md-3">
                                            <label for="bagian">Bagian</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="bagian" id="bagian" class="form-control">
                                                <option value="">Ini Bagian</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <table class="table table-stripped table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Nama Karyawan
                                        </th>
                                        <th>
                                            jam Lembur
                                        </th>
                                        <th>
                                            jenis Pekerjaan
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <select name="karyawan" id="" class="form-control select">
                                                <option>Nopebri Ade Candra</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" min="1" class="form-control" name="jamLembur">
                                        </td>
                                        <td>
                                            <Textarea class="form-control" cols="2">

                                           </Textarea>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm"> Add</button>
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
