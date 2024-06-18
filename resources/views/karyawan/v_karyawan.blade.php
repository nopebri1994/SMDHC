@extends('_main/main')
@section('container')
    <style type="text/css">
        .hidden {
            visibility: hidden;
            opacity: 0;
            display: none,
        }

        @keyframes alertHide {
            0% {
                transition: visibility 0s 2s, opacity 2s linear;
            }

            100% {
                display: none,
            }
        }
    </style>
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
                                @if (session('status'))
                                    <div class="alert alert-dismissible fade show" style="background-color: #bee6ff">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" id='alert'
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIK</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Dept. / Bagian</th>
                                            <th>Tanggal Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $key => $k)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $k->nikKerja }}</td>
                                                <td>{{ $k->namaKaryawan }}</td>
                                                <td>{{ $k->jabatan->namaJabatan }}</td>
                                                <td>{{ $k->departemen->kode }} / {{ $k->bagian->kode }}</td>
                                                <td>{{ varHelper::formatDate($k->tglMasuk) }}</td>
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
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            alert();
        })

        let alert = () => {
            let x = document.getElementById("alert");
            setTimeout(() => {
                x.click();
            }, 10000);
        }
    </script>
@endsection
