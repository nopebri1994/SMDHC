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
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            Cetak Absensi per orang
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="idKaryawan">Nama Karyawan</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="idKaryawan" class="select form-control" data-live-search="true"
                                            data-show-subtext="true" id="idKaryawan">
                                            <option value="0">-- Pilih Nama Karyawan --</option>
                                            @foreach ($karyawan as $k)
                                                <option value="{{ $k->uuid }}">{{ $k->namaKaryawan }}
                                                    &nbsp;({{ $k->nikKerja }})
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <label for="awal">Tanggal</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="date" name="awal" id="awal" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" name="akhir" id="akhir" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3" align="right">
                                    <button type="submit" class="btn btn-primary" id="btnPrint">
                                        <span class="fas fa-print" id="load" aria-hidden="true"></span>
                                        Cetak Absensi Harian</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body" style="height: 600px">
                            <iframe src="" frameborder="0" id="viewCetak" style="height:100%;width:100%">
                                {{-- <div id="viewCetak"></div> --}}
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script>
        $(document).ready(function() {

        });
        document.getElementById('btnPrint').onclick = () => {
            // alert('a')
            let awal = $('#awal').val()
            let akhir = $('#akhir').val()
            let id = $('#idKaryawan').val()
            if (awal == '' || akhir == '') {
                flasher.error('Tanggal harus diisi')
                exit();
            }
            if (id == 0) {
                flasher.error('Pilih nama karyawan terlebih dahulu');
                exit();
            }
            if (awal > akhir) {
                flasher.error('Tanggal Akhir tidak boleh lebih Kecil')
                exit();
            }

            data = {
                'idKaryawan': id,
                'awal': awal,
                'akhir': akhir
            }
            openLoader('Memuat data');
            document.getElementById("viewCetak").src = "{{ URL::to('/') }}/psn/cetakPerorang?idKaryawan=" +
                id + "&awal=" + awal + "&akhir=" + akhir
            setTimeout(() => {
                closeLoader();
            }, 5000);
        }
    </script>
@endsection
@endsection
