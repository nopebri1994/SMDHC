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
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Daftar Karyawan</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <form action="{{ URL::to('/karyawan/storData') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">{{ $title }}</h5>
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
                                                    placeholder="Nomor Induk Kerja" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Nama Karyawan
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="nama" id="nama"
                                                    placeholder="Nama Lengkap" class="form-control">
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
                                            <div class="col-md-4">
                                                <input type="date" name="tmt" id="tmt" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button class="btn btn-primary"><i class="fas fa-save"></i> Save Data
                                            Karyawan</button>
                                    </div>
                                </div>
                                {{-- <h5 class="m-0"></h5> --}}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Finger Print ID
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" placeholder="Finger/SA ID" name="fpId"
                                                    id="fpId" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                Perusahaan
                                            </div>
                                            <div class="col-md-7">
                                                <select name="perusahaan" id="perusahaan" class="form-control">
                                                    @foreach ($perusahaan as $p)
                                                        <option value="{{ $p->id }}">{{ $p->namaPerusahaan }}
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
                                            <div class="col-md-8">
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
                                            <div class="col-md-6">
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
                                                <select name="statusKaryawan" id="statusKaryawan" class="form-control">
                                                    <option value="1">Kontrak</option>
                                                    <option value="1">Tetap</option>
                                                    <option value="1">Honorer</option>
                                                    <option value="1">Harian</option>
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
                                                        <option value="{{ $j->id }}">{{ $j->kodeJabatan }}</option>
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
                                                        <option value="{{ $jk->id }}">{{ $jk->kodeJamKerja }}
                                                        </option>
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            listDepartemen();
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
    </script>
@endsection