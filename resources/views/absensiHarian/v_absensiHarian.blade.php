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
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="tglAbsen" class="pt-2">Tanggal</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                                name="tglAbsen" id="tglAbsen">
                                            <input type="hidden" id="token" value={{ csrf_token() }}>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn_orange btn-block mt-1" id="prev">
                                                <i class="fas fa-backward"></i> Prev</button>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn_orange btn-block mt-1" id="next">
                                                Next <i class="fas fa-forward"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row justify-content-end">
                                        @can('hc')
                                            <div class="col-md-5">
                                                <button class="btn btn_orange btn-block mt-1" id="btnProses">
                                                    <span class="fas fa-user-plus"></span>&nbsp;&nbsp;Proses Absensi
                                                    Harian</button>
                                            </div>
                                        @endcan
                                    </div>
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

        document.getElementById('tglAbsen').onchange = () => {
            loadData();
        }
        @can('hc')
            document.getElementById('btnProses').onclick = () => {
                prosesData()
            }
        @endcan
        let prosesData = () => {
            let data = {
                'tgl': $("#tglAbsen").val(),
                "_token": $("#token").val(),
            }

            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'post',
                url: 'absensiHarian/prosesAbsensi',
                data: data,
                success: function(sdata) {
                    let obj = JSON.parse(sdata);
                    if (obj.status == 0) {
                        flasher.error(obj.message);
                    } else {
                        flasher.success(obj.message);
                    }
                    loadData();
                    closeLoader();
                },
                error: function() {
                    flasher.error('Server Error')
                    closeLoader();
                }
            })
        }

        let loadData = () => {
            let data = {
                'tgl': $("#tglAbsen").val(),
                "_token": $("#token").val(),
            }
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'post',
                url: 'absensiHarian/list',
                data: data,
                success: function(sdata) {
                    $("#list").html(sdata)
                    closeLoader();
                },
                error: function() {
                    flasher.error('Server Error')
                    closeLoader();
                }
            })
        }

        document.getElementById('prev').onclick = () => {

            let last = $('#tglAbsen').val();
            let date = new Date(last);
            date.setDate(date.getDate() - 1)
            d = date.getDate().toString().padStart(2, '0')
            month = date.getMonth() + 1
            m = month.toString().padStart(2, '0')
            $('#tglAbsen').val(date.getFullYear() + '-' + m + '-' + d);
            loadData()

        }
        document.getElementById('next').onclick = () => {
            let last = $('#tglAbsen').val();
            let date = new Date(last);
            date.setDate(date.getDate() + 1)
            d = date.getDate().toString().padStart(2, '0')
            month = date.getMonth() + 1
            m = month.toString().padStart(2, '0')
            $('#tglAbsen').val(date.getFullYear() + '-' + m + '-' + d);
            loadData()
        }

        let updateFull = (x) => {
            let data = {
                'idAbsensi': x,
                'full': $('#full' + x).val(),
            }
            $.ajax({
                beforeSend: openLoader('Updates Status Masuk'),
                type: 'get',
                url: 'absensiHarian/updateFull',
                data: data,
                success: function(sdata) {
                    document.getElementById('full' + x).disabled = true;
                    flasher.success('Status Updated')
                    closeLoader();

                },
                error: function(error) {
                    flasher.error('Server Not Found');
                    closeLoader();
                }
            })
        }

        let updateTerlambat = (x) => {
            let data = {
                'idAbsensi': x,
                'terlambat': $('#terlambat' + x).val(),
            }
            $.ajax({
                beforeSend: openLoader('Updates Status Terlambat'),
                type: 'get',
                url: 'absensiHarian/updateTerlambat',
                data: data,
                success: function(sdata) {
                    document.getElementById('terlambat' + x).disabled = true;
                    closeLoader();
                },
                error: function(error) {
                    flasher.error('Server Not Found');
                    closeLoader();
                }
            })
        }
    </script>
@endsection
