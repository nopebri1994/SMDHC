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
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="storeData" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="row">
                                        <div class="col-md-3">Username</div>
                                        <div class="col-md-8">
                                            <input type="text" name="username" id="username" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">Nama Karyawan</div>
                                        <div class="col-md-9">
                                            <select name="idKaryawan" class="form-control" id="idKaryawan">
                                                @foreach ($karyawan as $k)
                                                    <option value="{{ $k->id }}">{{ $k->namaKaryawan }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">Role</div>
                                        <div class="col-md-4">
                                            <select name="role" class="form-control" id="role">
                                                <option value="1">Admin</option>
                                                <option value="2">Payroll</option>
                                                <option value="3">Personalia</option>
                                                <option value="4">Admin Departemen</option>
                                                <option value="5">Admin Bagian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">Password</div>
                                        <div class="col-md-8">
                                            <input type="text" name="pass" id="pass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <button type="submit" class="btn btn-primary" id="btnSaveData">
                                            <span class="far fa-save" id="load" aria-hidden="true"></span>
                                            Simpan Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-info d-none mb-2" id="showButton">
                                    <span class="far fa-plus" aria-hidden="true"></span> Add Data</button>
                            </div> --}}
                            {{-- <div class="text-center" id="spin">
                                <div class="spinner-grow text-info m-5" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div> --}}
                            {{-- <div class="table-responsive" id="listView"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
