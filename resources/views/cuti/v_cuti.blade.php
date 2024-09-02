@extends('_main/main')
@section('container')
    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background: rgb(237, 213, 118);
            border-bottom: 2px solid green;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">{{ $title }}</h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Personalia</li>
                        <li class="breadcrumb-item aktif"><a href="#">{{ $title }}</a></li>
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
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Detail Cuti Tahunan</a>
                                </li>
                                @can('hc')
                                    <li class="nav-item">
                                        <a class="nav-link" id="tambah-tab" data-toggle="tab" href="#tambah" role="tab"
                                            aria-controls="tambah" aria-selected="true">Tambah Cuti Tahunan perorang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="potong-tab" data-toggle="tab" href="#potong" role="tab"
                                            aria-controls="potong" aria-selected="true">Potong Cuti Tahunan Perorang</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="posting-tab" data-toggle="tab" href="#posting" role="tab"
                                            aria-controls="posting" aria-selected="false">Posting Cuti Tahunan</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                    {{-- isi --}}
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-5 pt-2">NIK (Kerja)</div>
                                                    <div class="col-md-7">
                                                        <input type="text" name="nikKerja" id="nikKerja"
                                                            autocomplete="off" placeholder="NIK" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-5">Nama Karyawan</div>
                                                    <div class="col-md-7">
                                                        <input type="text" name="nama" id="nama"
                                                            placeholder="nama" class="form-control" disabled>
                                                        <input type="hidden" name="" id="idKaryawan">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-5 pt-2">Dept / Bagian</div>
                                                    <div class="col-md-7">
                                                        <input type="text" name="dept" id="dept" placeholder=""
                                                            class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-5 pt-2">Tahun Cuti</div>
                                                    <div class="col-md-7">
                                                        <select name="year" class="form-control bg-info" id="year">
                                                            @for ($i = 2020; $i < 2030; $i++)
                                                                <option>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-block btn-secondary" id="findCuti">Cari
                                                            Data... &nbsp;<i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-header" align="right">
                                                <a href="cuti/" class="" id="cetakCuti">
                                                    <span class="fas fa-print"></span> Cetak
                                                    Cuti</a>
                                            </div>
                                            <div class="card-body">
                                                <div id="detailTable"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('hc')
                            <div class="tab-pane fade" id="posting" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row mt-2">
                                                        <div class="col-md-3 pt-2">Bulan</div>
                                                        <div class="col-md-8">
                                                            <select name="postingMonth" class="form-control bg-info"
                                                                id="postingMonth">
                                                                <option value="1">Januari</option>
                                                                <option value="2">Februari</option>
                                                                <option value="3">Maret</option>
                                                                <option value="4">April</option>
                                                                <option value="5">Mei</option>
                                                                <option value="6">Juni</option>
                                                                <option value="7">July</option>
                                                                <option value="8">Agustus</option>
                                                                <option value="9">September</option>
                                                                <option value="10">Oktober</option>
                                                                <option value="11">Nopember</option>
                                                                <option value="12">Desember</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-3 pt-2">Tahun</div>
                                                        <div class="col-md-8">
                                                            <select name="postingYear" class="form-control bg-info"
                                                                id="postingYear">
                                                                @for ($i = 2020; $i < 2030; $i++)
                                                                    <option {{ $i == 2024 ? 'selected' : '' }}>
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-3">

                                                        </div>
                                                        <div class="col-md-8">
                                                            <button class="btn btn-success form-control" data-toggle="modal"
                                                                data-target="#verifikasiPosting">Posting Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="postingTable"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tambah" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4 pt-2">NIK (Kerja)</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="nikKerjaTambah" id="nikKerjaTambah"
                                                                autocomplete="off" placeholder="NIK" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4">Nama Karyawan</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="namaTambah" id="namaTambah"
                                                                placeholder="nama" class="form-control" disabled>
                                                            <input type="hidden" name="" id="idKaryawanTambah">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Dept / Bagian</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="deptTambah" id="deptTambah"
                                                                placeholder="" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Tahun Cuti</div>
                                                        <div class="col-md-8">
                                                            <select name="yearTambah" class="form-control bg-info"
                                                                id="yearTambah">
                                                                @for ($i = 2024; $i < 2030; $i++)
                                                                    <option>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Tambah Cuti</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="cutiTambah" id="cutiTambah"
                                                                placeholder="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Keterangan</div>
                                                        <div class="col-md-8">
                                                            <textarea name="ketTambah" class="form-control" id="ketTambah" cols="" rows=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-block btn-secondary" id="tambahCuti">Tambah
                                                                Cuti... &nbsp;<i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="listTambah"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="potong" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4 pt-2">NIK (Kerja)</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="nikKerjaPotong" id="nikKerjaPotong"
                                                                autocomplete="off" placeholder="NIK" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4">Nama Karyawan</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="namaPotong" id="namaPotong"
                                                                placeholder="nama" class="form-control" disabled>
                                                            <input type="hidden" name="" id="idKaryawanPotong">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Dept / Bagian</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="deptPotong" id="deptPotong"
                                                                placeholder="" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Tahun Cuti</div>
                                                        <div class="col-md-8">
                                                            <select name="yearPotong" class="form-control bg-info"
                                                                id="yearPotong">
                                                                @for ($i = 2024; $i < 2030; $i++)
                                                                    <option>{{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Potong Cuti</div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="cutiPotong" id="cutiPotong"
                                                                placeholder="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 pt-2">Keterangan</div>
                                                        <div class="col-md-8">
                                                            <textarea name="ketPotong" class="form-control" id="ketPotong" cols="" rows=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-block btn-secondary" id="potongCuti">Potong
                                                                Cuti... &nbsp;<i class="fas fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="listPotong"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                    {{-- endisi --}}
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="token" value={{ csrf_token() }}>
    {{-- modal --}}

    <!-- Modal -->
    <div class="modal fade" id="verifikasiPosting" role="dialog" aria-labelledby="Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Title">&nbsp;</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline"
                            type="checkbox" id="verifikasi">
                        <label for="verifikasi" class="custom-control-label">Verifikasi posting cuti</label>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="buttonVerifikasiPosting" class="btn btn-primary form-control">Posting
                        Data</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            loadPostingCuti();
            $("#listTambah").load("cuti/listTambah");
            $("#listPotong").load("cuti/listPotong");
        });

        let loadPostingCuti = () => {
            let month = $('#postingMonth').val();
            let year = $('#postingYear').val();

            let data = {
                'm': month,
                'y': year
            }
            $.ajax({
                type: 'get',
                url: 'cuti/tabel-cuti',
                data: data,
                success: function(sData) {
                    $('#postingTable').html(sData);
                },
                error: function() {
                    flasher.error('Server Not Found')
                }
            })
        }

        document.getElementById('nikKerja').oninput = () => {
            let nik = $('#nikKerja').val();
            getDetail(nik);
        }

        @can('hc')
            document.getElementById('postingYear').onchange = () => {
                loadPostingCuti();
            }

            document.getElementById('postingMonth').onchange = () => {
                loadPostingCuti();
            }

            document.getElementById('nikKerjaTambah').oninput = () => {
                let nik = $('#nikKerjaTambah').val();
                getDetailTambah(nik);
            }

            document.getElementById('nikKerjaPotong').oninput = () => {
                let nik = $('#nikKerjaPotong').val();
                getDetailPotong(nik);
            }

            document.getElementById('tambahCuti').onclick = () => {
                let idKaryawan = $('#idKaryawanTambah').val();
                let data = {
                    'idKaryawan': idKaryawan,
                    'tahun': $('#yearTambah').val(),
                    '_token': $('#token').val(),
                    'tambahCuti': $('#cutiTambah').val(),
                    'ketTambah': $('#ketTambah').val()

                };
                $.ajax({
                    beforeSend: openLoader('Memuat Data'),
                    type: 'post',
                    url: 'cuti/tambahCuti',
                    data: data,
                    success: function() {
                        $('#cutiTambah').val('')
                        $('#nikKerjaTambah').val('');
                        $('#idKaryawanTambah').val('');
                        $('#namaTambah').val('');
                        $('#deptTambah').val('');
                        $('#ketTambah').val('');
                        $("#listTambah").load("cuti/listTambah");
                        closeLoader();
                    },
                    error: function(error) {
                        closeLoader();
                        flasher.error('Server Error');
                    }
                })
            }
            document.getElementById('potongCuti').onclick = () => {
                let idKaryawan = $('#idKaryawanPotong').val();
                let data = {
                    'idKaryawan': idKaryawan,
                    'tahun': $('#yearPotong').val(),
                    '_token': $('#token').val(),
                    'cutiPotong': $('#cutiPotong').val(),
                    'ketPotong': $('#ketPotong').val()
                };
                $.ajax({
                    beforeSend: openLoader('Memuat Data'),
                    type: 'post',
                    url: 'cuti/potongCuti',
                    data: data,
                    success: function() {
                        $('#cutiPotong').val('')
                        $('#nikKerjaPotong').val('');
                        $('#idKaryawanPotong').val('');
                        $('#namaPotong').val('');
                        $('#deptPotong').val('');
                        $('#ketPotong').val('');
                        $("#listPotong").load("cuti/listPotong");
                        closeLoader();
                    },
                    error: function(error) {
                        closeLoader();
                        flasher.error('Server Error');
                    }
                })
            }
        @endcan


        let getDetailPotong = (x) => {
            let data = {
                'nik': x,
            }
            $.ajax({
                type: 'get',
                url: 'cuti/detail-data',
                data: data,
                success: function(sdata) {
                    let obj = JSON.parse(sdata);
                    if (obj.status == 1) {
                        $('#namaPotong').val(obj.namaKaryawan);
                        $('#deptPotong').val(obj.deptBagian);
                        $('#idKaryawanPotong').val(obj.idKaryawan);
                    }
                },
            })
        }

        let getDetailTambah = (x) => {
            let data = {
                'nik': x,
            }
            $.ajax({
                type: 'get',
                url: 'cuti/detail-data',
                data: data,
                success: function(sdata) {
                    let obj = JSON.parse(sdata);
                    if (obj.status == 1) {
                        $('#namaTambah').val(obj.namaKaryawan);
                        $('#deptTambah').val(obj.deptBagian);
                        $('#idKaryawanTambah').val(obj.idKaryawan);
                    }
                },
            })
        }


        let getDetail = (x) => {
            let data = {
                'nik': x,
            }
            $.ajax({
                type: 'get',
                url: 'cuti/detail-data',
                data: data,
                success: function(sdata) {
                    let obj = JSON.parse(sdata);
                    if (obj.status == 1) {
                        $('#nama').val(obj.namaKaryawan);
                        $('#dept').val(obj.deptBagian);
                        $('#idKaryawan').val(obj.idKaryawan);
                    }
                },
            })
        }

        document.getElementById('findCuti').onclick = () => {
            getCuti();
        }

        let getCuti = () => {
            let id = $('#idKaryawan').val();
            let year = $('#year').val();

            let data = {
                'id': id,
                'year': year
            };

            $.ajax({
                type: 'get',
                url: 'cuti/detail-cuti',
                data: data,
                success: function(sdata) {
                    $('#detailTable').html(sdata);
                },
                error: function(error) {
                    $('#detailTable').html('');
                    flasher.error('Data Not Found');
                }
            })
        }

        document.getElementById('buttonVerifikasiPosting').onclick = () => {
            let verifikasi = document.getElementById('verifikasi');
            const date = new Date('{{ date('Y-m-d') }}');
            if (verifikasi.checked != true) {
                flasher.error('Verifikasi Gagal');
            } else {
                let month = $('#postingMonth').val();
                let year = $('#postingYear').val();

                if (month != date.getMonth() + 1) {
                    flasher.error('Bulan posting Salah, Cek Input Data');
                    $('#verifikasiPosting').modal('toggle');
                    return;
                }
                if (+year != date.getFullYear()) {
                    flasher.error('Tahun posting Salah, Cek Input Data');
                    $('#verifikasiPosting').modal('toggle');
                    return;
                }

                let data = {
                    'm': month,
                    'y': year,
                    '_token': $('#token').val(),
                }
                $.ajax({
                    type: 'post',
                    url: 'cuti/posting-cuti',
                    data: data,
                    success: function(sData) {
                        flasher.success('Posting Cuti Succes');
                        loadPostingCuti();
                    },
                    error: function() {
                        flasher.error('Server Not Found')
                    }
                })
                $('#verifikasiPosting').modal('toggle');
                verifikasi.checked = false;
            }
        }
    </script>
@endsection
