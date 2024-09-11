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
                        <li class="breadcrumb-item">Personalia</li>
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
                            <div class="col-12" align="right">
                                <a href="fkp/addData" class="btn btn-primary btn-sm"><span
                                        class="fas fa-plus"></span>&nbsp;Tambah
                                    Data Pelatihan</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <table class="tbl table table-bordered table striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIK</th>
                                        <th>Nama Karyawan</th>
                                        <th>type Pelatihan</th>
                                        <th>Jenis Pelatihan</th>
                                        <th>Tgl. Mulai</th>
                                        <th>Tgl. Selesai</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
            @if (session('status'))
                flasher.success('{{ session('status') }}');
            @endif
        })

        $('.tbl').DataTable({
            responsive: true
        });
    </script>
@endsection
