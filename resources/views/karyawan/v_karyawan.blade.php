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

                            {{-- <form action="karyawan/export" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" name="file">
                                <button>export</button>
                            </form> --}}

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
                                <div class="table-responsive-md">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center align-middle" style="height: 3rem">
                                                <th class="align-middle">#</th>
                                                <th class="align-middle">NIK</th>
                                                <th class="align-middle">Nama Karyawan</th>
                                                <th class="align-middle">Jabatan</th>
                                                <th class="align-middle">Dept. / Bagian</th>
                                                <th class="align-middle">Jenis Kelamin</th>
                                                <th class="align-middle">Tanggal Masuk</th>
                                                <th class="align-middle"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($karyawan as $key => $k)
                                                <tr>
                                                    <td class="text-center">{{ $karyawan->firstItem() + $key }}</td>
                                                    <td>{{ $k->nikKerja }}</td>
                                                    <td>{{ $k->namaKaryawan }}</td>
                                                    <td>{{ $k->jabatan->namaJabatan }}</td>
                                                    <td>{{ $k->departemen->kode }} / {{ $k->bagian->kode }}</td>
                                                    <td class="align-middle text-center">
                                                        @if ($k->jenisKelamin == '1')
                                                            <span class="badge badge-success" style="font-size:0.8rem">
                                                                {{ varHelper::varJK($k->jenisKelamin) }}
                                                            </span>
                                                        @else
                                                            <span class="badge badge-danger" style="font-size:0.8rem">
                                                                {{ varHelper::varJK($k->jenisKelamin) }}
                                                            </span>
                                                        @endif

                                                    </td>
                                                    <td class="text-center">{{ varHelper::formatDate($k->tglMasuk) }}</td>
                                                    <td class="align-middle text-center">
                                                        <div class="btn-group" role="group">
                                                            <button id="btnGroupDrop1" type="button"
                                                                class="btn btn-primary dropdown-toggle btn-sm"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                <a class="dropdown-item"
                                                                    href="{{ URL::to("dk/karyawan/detail-data/$k->uuid") }}">Detail
                                                                    Data</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ URL::to("dk/karyawan/edit-data/$k->uuid") }}">Edit</a>
                                                                {{-- <a class="dropdown-item" href="#">Delete</a> --}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        {{ $karyawan->links() }}
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
