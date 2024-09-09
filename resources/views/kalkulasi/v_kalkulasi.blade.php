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
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="karyawan" class="select" id="karyawan">
                                        <option value="">Semua Data Karyawan</option>
                                        @foreach ($karyawan as $k)
                                            <option value="{{ $k->id }}">
                                                {{ $k->namaKaryawan }}&nbsp;({{ $k->nikKerja }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                                <div id="list"></div>
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
            loadData();
        });

        document.getElementById('btnView').onclick = () => {
            let tglAwal = $('#tglAwal').val();
            let tglAkhir = $('#tglAkhir').val();
            if (tglAwal == '' || tglAkhir == '') {
                flasher.error('Periode tidak boleh kosong');
                return;
            }
            if (tglAwal > tglAkhir) {
                flasher.error('Periode awal tidak boleh lebih besar');
                return;
            }
            loadData();
        }
        let loadData = () => {
            let id = $('#karyawan').val();
            let tglAwal = $('#tglAwal').val();
            let tglAkhir = $('#tglAkhir').val();
            let data = {
                'id': id,
                'tglAwal': tglAwal,
                'tglAkhir': tglAkhir,
            };
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'Get',
                url: 'kalkulasi/tabelData',
                data: data,
                success: function(html) {
                    $('#list').html(html)
                    closeLoader();
                },
                error: function() {
                    closeLoader();
                    flasher.error('server error');
                }
            })
        }
    </script>
@endsection
