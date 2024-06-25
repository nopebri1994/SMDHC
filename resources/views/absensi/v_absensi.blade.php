@extends('_main/main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
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
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">Nomor Kerja</div>
                                        <div class="col-md-4">
                                            <input type="text" id="nik" class="form-control">
                                            <input type="hidden" id="idKaryawan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">Nama Karyawan</div>
                                        <div class="col-md-7">
                                            <input type="text" id="nama" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">Keterangan Ijin</div>
                                        <div class="col-md-6">
                                            <select name="" id="kodeIjin" class="form-control">
                                                <option value="">--- pilih data ---</option>
                                                @foreach ($ket as $k)
                                                    <option value="{{ $k->kode }}">{{ $k->kode }} |
                                                        {{ $k->keterangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">Tanggal Ijin *
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date" name="awal" id="awal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date" name="akhir" id="akhir" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">Tahun Cuti / Pemotongan Cuti **</div>
                                        <div class="col-md-8">
                                            <select name="year" class="form-control " id="year" disabled>
                                                <option value="">--- pilih data ---</option>
                                                @for ($i = 2023; $i < 2030; $i++)
                                                    <option>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">Keterangan</div>
                                        <div class="col-md-8">
                                            <textarea name="" id="ket" class="form-control" disabled></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <button class="btn btn-sm btn-block btn-info" id="btnSave" disabled><span
                                                    class="fa fa-save"></span>
                                                Simpan Data</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <i style="color:red">Keterangan :
                                                <br> *) Isi hanya satu kolom tanggal jika ijin dilakukan hanya 1 hari /
                                                jika lebih dari 1 hari maka isi kolom tanggal ke dua (sampai dengan
                                                tanggal).
                                                <br>
                                                **) Tahun cuti / pemotongan diisi jika keterangan ijin menggunakan kode AL
                                                (Cuti Tahunan) / AD (Hutang Cuti).
                                            </i>
                                        </div>
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
        document.getElementById('kodeIjin').onchange = () => {
            $('#ket').val('');
            document.getElementById('btnSave').disabled = false;
            let kode = $('#kodeIjin').val();
            if (kode == 'AL' || kode == 'AD') {
                document.getElementById('year').disabled = false;
                document.getElementById('btnSave').disabled = true;
            } else {
                document.getElementById('year').disabled = true;
                document.getElementById('btnSave').disabled = false;
            }
        }

        document.getElementById('nik').oninput = () => {
            $('#ket').val('');
            let nik = $('#nik').val();
            getDetail(nik);
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
                        document.getElementById('btnSave').disabled = false;
                    }
                },
            })
        }

        document.getElementById('year').onchange = () => {
            $('#ket').val('');
            getKet();
        }

        let getKet = () => {
            let id = $('#idKaryawan').val();
            let kode = $('#kodeIjin').val();
            let year = $('#year').val();
            let data = {
                'id': id,
                'kode': kode,
                'y': year,
            }
            $.ajax({
                type: 'get',
                url: 'absensi/detailData',
                data: data,
                success: function(sdata) {
                    let obj = JSON.parse(sdata);
                    if (obj.status == 0) {
                        $('#ket').val(obj.message);
                        document.getElementById('btnSave').disabled = true;
                    } else {
                        $('#ket').val(obj.message);
                        document.getElementById('btnSave').disabled = false;
                    }
                },
                error: function(error) {
                    flasher.error('server Not Found');
                }
            })
        }

        document.getElementById('btnSave').onclick = () => {
            let awal = $('#awal').val();
            if (awal == '') {
                flasher.error('Tanggal Harus diisi')
                return;
            }
        }
    </script>
@endsection
