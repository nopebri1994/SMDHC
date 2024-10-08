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
            <div class="mt-2">
                <form action="{{ URL::to('/dk/karyawan/storeData') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ URL::to('/') }}/dk/karyawan" class="btn btn-danger"><i
                                                class="fas fa-backward"></i>
                                            Back</a>
                                        <button class="btn btn-primary"><i class="fas fa-save"></i> Save Data
                                            Karyawan</button>
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
                                                    <input type='text' name="nikKerja" id="nikKerja"
                                                        placeholder="Nomor Induk Kerja" value="{{ old('nikKerja') }}"
                                                        class="form-control {{ $errors->has('nikKerja') ? 'is-invalid' : '' }}">
                                                    <div class="invalid-feedback">{{ $errors->first('nikKerja') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Nama Karyawan
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="nama" id="nama"
                                                        placeholder="Nama Lengkap" value="{{ old('nama') }}"
                                                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}">
                                                    <div class="invalid-feedback">{{ $errors->first('nama') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Jenis Kelamin
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="JK" id="JK" class="form-control">
                                                        <option value="1">Laki - Laki</option>
                                                        <option value="2">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Tanggal Masuk
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="date" name="tmt" id="tmt"
                                                        value="{{ old('tmt') }}"
                                                        class="form-control {{ $errors->has('tmt') ? 'is-invalid' : '' }}">
                                                    <div class="invalid-feedback">{{ $errors->first('tmt') }}</div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Email
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="email" name="email" placeholder="Email aktif"
                                                        id="email" class="form-control">
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
                                                    <input type="number" placeholder="Finger/SA ID" name="fpId"
                                                        id="fpId" value="{{ old('fpId') }}"
                                                        class="form-control {{ $errors->has('fpId') ? 'is-invalid' : '' }}">
                                                    <div class="invalid-feedback">{{ $errors->first('fpId') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Perusahaan
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="perusahaan" id="perusahaan" class="form-control">
                                                        @foreach ($perusahaan as $p)
                                                            <option value="{{ $p->id }}">
                                                                {{ $p->namaPerusahaan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Departemen
                                                </div>
                                                <div class="col-md-5">
                                                    <select name="departemen" id="departemen" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Bagian
                                                </div>
                                                <div class="col-md-7">
                                                    <select name="bagian" id="bagian" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Status Karyawan
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="statusKaryawan" id="statusKaryawan"
                                                        class="form-control">
                                                        <option value="1">Kontrak</option>
                                                        <option value="2">Tetap</option>
                                                        <option value="3">Honorer</option>
                                                        <option value="4">Harian</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Kode Jabatan
                                                </div>
                                                <div class="col-md-2">
                                                    <select name="jabatan" id="jabatan" class="form-control">
                                                        @foreach ($jabatan as $j)
                                                            <option value="{{ $j->id }}">
                                                                {{ $j->kodeJabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="namaJabatan" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Kode Jam Kerja
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="jamKerja" id="jamKerja" class="form-control">
                                                        @foreach ($jamKerja as $jk)
                                                            <option value="{{ $jk->id }}">
                                                                {{ $jk->kodeJamKerja }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Group Sabtu OFF
                                                </div>
                                                <div class="col-md-5">
                                                    <select name="groupOff" id="groupOff" class="form-control">
                                                        <option value="0">Non Off</option>
                                                        <option value="A">Group Off A</option>
                                                        <option value="B">Group Off B</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    Group Kerja
                                                </div>
                                                <div class="col-md-4">
                                                    <select name="groupKerja" id="groupKerja" class="form-control">
                                                        <option value="null">-- none --</option>
                                                        @foreach ($groupKerja as $g)
                                                            <option value="{{ $g->id }}">
                                                                {{ $g->groupKerja }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            listDepartemen();
            detailJabatan();
            let x = '{{ $errors->any() }}';
            if (x > 0) {
                flasher.error('Data tidak boleh kosonng / tidak sesuai.');
            }
        });

        document.getElementById('perusahaan').onchange = () => {
            listDepartemen();
        };

        document.getElementById('departemen').onchange = () => {
            listBagian();
        };

        let listDepartemen = () => {
            let perusahaan = $('#perusahaan').val();
            let route = '{{ URL::to('/dm/departemen/selectDepartemen') }}';
            let data = {
                'idPerusahaan': perusahaan,
            };
            $.ajax({
                type: 'get',
                url: route,
                data: data,
                success: function(sdata) {
                    $('select#departemen').html(sdata);
                    listBagian();
                },
                error: function(error) {
                    alert('Data Not Found')
                }
            });
        };

        let listBagian = () => {
            let departemen = $('#departemen').val();
            let route = '{{ URL::to('/dm/bagian/selectBagian') }}';
            let data = {
                'idDepartemen': departemen,
            };
            $.ajax({
                type: 'get',
                url: route,
                data: data,
                success: function(sdata) {
                    $('select#bagian').html(sdata);
                },
                error: function(error) {
                    alert('Data Not Found');
                }
            })
        };

        document.getElementById('jabatan').onchange = () => {
            detailJabatan();
        }

        let detailJabatan = () => {
            let jabatan = $('#jabatan').val();
            let route = '{{ URL::to('/dm/jabatan/detailJabatan') }}';
            let data = {
                'idJabatan': jabatan,
            };
            $.ajax({
                type: 'get',
                url: route,
                data: data,
                success: function(sdata) {
                    $('#namaJabatan').val(sdata);
                },
                error: function(error) {
                    alert('Data Not Found');
                }

            });
        }
    </script>
@endsection
