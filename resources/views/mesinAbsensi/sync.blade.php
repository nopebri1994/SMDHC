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
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h5 class="m-0">{{ $title }}</h5> --}}
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">Nama Mesin</div>
                                    <div class="col-md-9">
                                        <select name="idMesin" id="idMesin" class="form-control">
                                            @foreach ($data as $key => $l)
                                                <option value="{{ $l->id }}">{{ $l->namaMesin }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="token" value={{ csrf_token() }}>
                                    </div>
                                </div>

                                <div class="mt-3" align="right">
                                    <button type="button" class="btn btn-primary" id="btnConnect">
                                        Connect</button>
                                    <button type="button" class="btn btn_orange" id="btnTarik" disabled>
                                        Tarik Data</button>
                                </div>
                                <b>Status Mesin : <i><span style="color: red" id="status" /></i></b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body" style="">
                            <div class="" style="" id="listView"></div>
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
            $('#status').text('Cek Connection')
        });

        document.getElementById('btnConnect').onclick = () => {
            connect()
        }

        document.getElementById('btnTarik').onclick = () => {
            let data = {
                'id': $('#idMesin').val(),
                "_token": $('#token').val(),
            }
            $.ajax({
                beforeSend: openLoader('Tarik Data Absensi, Mohon Menunggu'),
                type: 'get',
                url: 'mesinAbsensi-sync/tarikData',
                data: data,
                success: function(sdata) {
                    // let obj = JSON.parse(sdata);
                    $('#listView').html(sdata);
                    closeLoader();
                    flasher.success("Data Berhasil Ditarik")
                },
                error: function(error) {
                    flasher.error("Mesin Absensi error, coba lagi")
                    closeLoader();
                }
            })

        }

        let connect = () => {
            let data = {
                'id': $('#idMesin').val()
            }
            $.ajax({
                beforeSend: openLoader('cek koneksi ke mesin absen'),
                type: 'get',
                url: 'mesinAbsensi-sync/connect',
                data: data,
                success: function(sdata) {
                    let obj = JSON.parse(sdata);
                    if (obj.status == 'Connected') {
                        flasher.success(obj.status)
                        $('#status').text(obj.status)
                        document.getElementById('status').style.color = '#099926';
                        document.getElementById('btnTarik').disabled = false;
                        closeLoader();
                    } else {
                        flasher.error(obj.status)
                        document.getElementById('status').style.color = 'red';
                        document.getElementById('btnTarik').disabled = True;
                        closeLoader();
                    }
                },
                error: function(error) {
                    closeLoader();
                    flasher.error("Server error")
                }
            })
        }
    </script>
@endsection
