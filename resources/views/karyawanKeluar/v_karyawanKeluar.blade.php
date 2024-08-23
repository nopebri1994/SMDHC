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
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="karyawanKeluar/storeData" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="idKaryawan"> Nama Karyawan</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select name="idKaryawan"
                                                class="select {{ $errors->has('idKaryawan') ? 'is-invalid' : '' }}"
                                                data-live-search="true" data-show-subtext="true" id="idKaryawan">
                                                <option value="">Pilih Nama Karyawan</option>
                                                @foreach ($karyawan as $k)
                                                    <option value="{{ $k->id }}"
                                                        @if (old('idKaryawan') == $k->id) selected @endif>
                                                        {{ $k->namaKaryawan }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('idKaryawan') }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="tanggalKeluar">Tanggal</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date"
                                                class="form-control {{ $errors->has('tanggalKeluar') ? 'is-invalid' : '' }}"
                                                name="tanggalKeluar" id="tanggalKeluar">
                                            <div class="invalid-feedback">{{ $errors->first('tanggalKeluar') }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="keterangan" id="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                                                rows="3"></textarea>
                                            <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
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
                            <div class="table-responsive" id="listView"></div>
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
            $('#listView').load('karyawanKeluar/tabelData')
            $('.select').selectpicker({
                style: "bg-info",
            });
        });
    </script>
@endsection
