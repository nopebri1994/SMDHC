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
                        <li class="breadcrumb-item">Payroll</li>
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
                    <div class="card collapsed-card" id="cardForm">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-sm btn-danger" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>&nbsp; Tampilkan Form
                                </button>
                            </div>
                            <h5 class="m-0">Tambah Data / Update Data </h5>

                            {{-- progres Bar --}}
                            <div class="alert alert-success success__msg bg-light mt-4" style="display: none; color: white;"
                                role="alert">
                            </div>
                            <div class="progress d-none">
                                <div class="progress-bar progress-bar-striped" id="progres" role="progressbar"
                                    style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">12%
                                </div>
                            </div>
                            {{-- end --}}
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                            <form action="advance/store" method="POST" id="upload" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="idKaryawan"> Nama Karyawan</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select name="idKaryawan" id="idKaryawan" class="select"
                                                    data-live-search="true" data-show-subtext="true" required>
                                                    <option value="">Pilih Nama Karyawan</option>
                                                    @foreach ($karyawan as $k)
                                                        <option value="{{ $k->id }}">
                                                            {{ $k->namaKaryawan }}
                                                            &nbsp;({{ $k->nikKerja }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="noPinjaman">No. Pinjaman</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="noPinjaman" id="noPinjaman"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="tanggalRealisasi">Tanggal Realisasi</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="date" class="form-control" name="tanggalRealisasi"
                                                    id="tanggalRealisasi" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label>Jumlah Pinjaman</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="jumlahPinjaman"
                                                    id="jumlahPinjaman" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="jumlahPotongan">Jumlah Potongan</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" min="0" class="form-control"
                                                    name="jumlahPotongan" id="jumlahPotongan" required>
                                            </div>
                                        </div>
                                        <div class="mt-3" align="right">
                                            <input type="hidden" name="id" id="id">
                                            <button type="submit" class="btn btn-primary" id="btnSaveData">
                                                <span class="far fa-save" id="load" aria-hidden="true"></span>
                                                Simpan Data</button>
                                            <button type="button" class="btn btn-danger d-none" id="btnCancel">
                                                Cancel Update</button>
                                            <button type="submit" class="btn btn-success d-none" id="btnUpdateData">
                                                Update Data</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 pt-1">
                                    <select name="idKaryawan2" id="idKaryawan2" class="select form-control"
                                        data-live-search="true" data-show-subtext="true" required>
                                        <option value="0">Pilih Nama Karyawan</option>
                                        @foreach ($karyawan as $k)
                                            <option value="{{ $k->id }}">
                                                {{ $k->namaKaryawan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 text-right">
                                    <label for="" class="pt-2">Laporan</label>
                                </div>
                                <div class="col-md-2 pt-1">
                                    <select name="month" id="month" class="form-control">
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
                                <div class="col-md-2 pt-1">

                                    <select name="year" id="year" class="form-control">
                                        @for ($i = 2024; $i < 2030; $i++)
                                            <option>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 pt-1">
                                    <button class="btn btn_orange btn-block" id="btnCetak">Cetak</button>
                                </div>
                                <div class="col-md-2 pt-1">
                                    <button class="btn btn-primary btn-block" id="btnProses"> Proses
                                        Advance</button>
                                </div>
                            </div>
                            <hr>
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
    <script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.form.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function() {
            rupiah();
            number();
            loadData();
        });

        let rupiah = () => {
            $('#jumlahPinjaman').inputmask("Rp 999.999.999", {
                numericInput: true,
                righyAlign: true,
                oncleared: true
            })
        }

        let number = () => {
            let tahun = new Date();
            $.ajax({
                type: 'get',
                url: 'advance/get_id',
                success: function(sdata) {
                    if (sdata['last'] == '0') {
                        $('#noPinjaman').val(tahun.getFullYear() + '-' + '001');
                    } else {
                        split = sdata['last'].split('-');
                        if (tahun.getFullYear() == split[0]) {
                            end = parseInt(split[1]) + 1
                            $('#noPinjaman').val(tahun.getFullYear() + '-' + addLeadingZeros(end, 3));
                        } else {
                            $('#noPinjaman').val(tahun.getFullYear() + '-' + '001');
                        }
                    }
                },
                error: function() {
                    flasher.error('Server Error');
                }
            })
        }

        document.getElementById('btnProses').onclick = () => {
            prosesPotong();
        }

        let prosesPotong = () => {
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'get',
                url: 'advance/prosesData',
                success: function(sdata) {
                    if (sdata['error'] == '') {
                        flasher.success(sdata['success']);
                        loadData();
                    } else {
                        flasher.error(sdata['error'])
                    }
                    closeLoader();
                },
                error: function() {
                    flasher.error('Server Error');
                    closeLoader();
                }
            })
        }

        let addLeadingZeros = (num, length) => {
            return String(num).padStart(length, '0');
        }

        document.getElementById('idKaryawan2').onchange = () => {
            loadData();
        }

        document.getElementById('btnCetak').onclick = () => {
            let m = $('#month').val();
            let y = $('#year').val();

            window.open("advance/cetakLaporan?m=" + m + "&y=" + y);
        }

        let loadData = () => {
            let id = $('#idKaryawan2').val();
            let data = {
                'id': id,
            }
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'get',
                url: 'advance/tabelData',
                data: data,
                success: function(sdata) {
                    $('#list').html(sdata);
                    closeLoader();
                },
                error: function() {
                    flasher.error('Server Error');
                    closeLoader();
                }
            })
        }
        //progres with ajaxFOrm add
        $(function() {
            $(document).ready(function() {
                let message = $('.success__msg');
                let elem = document.getElementById("progres");
                $('#upload').ajaxForm({
                    beforeSend: function() {
                        openLoader('Simpan Data');
                        let percentage = '0';
                        $('.progress').removeClass('d-none')
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        let percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%',
                            function() {
                                return $(this).attr("aria-valuenow", percentage) + "%"
                            })
                        elem.innerHTML = percentage;
                    },
                    complete: function(xhr) {
                        closeLoader();
                        if (xhr['responseJSON']['error'] != '') {
                            message.fadeIn().removeClass('alert-success').addClass(
                                'alert-danger');
                            message.text(xhr['responseJSON']['error']);
                            setTimeout(function() {
                                message.fadeOut();
                                percentage = '0';
                                elem.innerHTML = percentage
                                $('.progress .progress-bar').css("width",
                                    percentage +
                                    '%')
                            }, 2000);
                            setTimeout(function() {
                                $('.progress').addClass('d-none')
                            }, 4000)
                        } else {
                            message.fadeIn().removeClass('alert-danger').addClass(
                                'alert-success');
                            message.text(xhr['responseJSON']['success']);
                            setTimeout(function() {
                                message.fadeOut();
                                percentage = '0';
                                elem.innerHTML = percentage
                                $('.progress .progress-bar').css("width",
                                    percentage +
                                    '%')
                                $('.progress').addClass('d-none')
                                $('#tanggalRealisasi').val('');
                                $('#jumlahPinjaman').val('');
                                $('#jumlahPotongan').val('');
                                $('#idKaryawan').val('').trigger('change');
                                document.getElementById('noPinjaman').disabled = false;
                                number();
                                $('.custom-file-label').html('Choose file');
                                btnCancel();
                            }, 2000);
                            // $('#list').load('kontrak-karyawan/tabelData')
                            loadData();
                        }
                    }
                });
            });
        });


        let deleteData = (id, nama) => {
            let token = $('#token').val();
            let dataId = {
                'id': id,
                "_token": token,
            };
            Swal.fire({
                title: "Do you want to delete field " + nama + "?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Delete",
                denyButtonText: `Cancel`,
                denyButtonColor: `#636363`,
                confirmButtonColor: '#ff2c2c',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        beforeSend: openLoader('memuatdata'),
                        type: 'post',
                        url: 'advance/delete',
                        data: dataId,
                        success: function() {
                            loadData();
                            flasher.success('Data Berhasil dihapus')
                            closeLoader();
                        },
                        error: function() {
                            flasher.error('Data Gagal dihapus')
                            closeLoader();

                        }

                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        }

        let editData = (id, tgl, idKaryawan, totalPinjaman, totalPotongan, sudahdiPotong, sisaPotong) => {
            $('#cardForm').CardWidget('toggle')
            let action = 'advance/update'
            $('#tanggalRealisasi').val(tgl);
            $('#jumlahPinjaman').val(totalPinjaman);
            $('#jumlahPotongan').val(totalPotongan);
            $('#noPinjaman').val(id);
            $('#id').val(id);
            $('#idKaryawan').val(idKaryawan).trigger('change');
            document.getElementById('noPinjaman').disabled = true;
            document.getElementById('btnSaveData').classList.add('d-none')
            document.getElementById('btnUpdateData').classList.remove('d-none')
            document.getElementById('btnCancel').classList.remove('d-none')
            document.getElementById('upload').action = action
        }

        let btnCancel = () => {
            $('#cardForm').CardWidget('toggle')
            let action = 'advance/store'
            $('#tanggalRealisasi').val('');
            $('#jumlahPinjaman').val('');
            $('#jumlahPotongan').val('');
            $('#idKaryawan').val('').trigger('change');
            number();
            document.getElementById('noPinjaman').disabled = false;
            document.getElementById('btnSaveData').classList.remove('d-none')
            document.getElementById('btnUpdateData').classList.add('d-none')
            document.getElementById('btnCancel').classList.add('d-none')
            document.getElementById('upload').action = action
        }

        document.getElementById('btnCancel').onclick = () => {
            btnCancel();
        }
    </script>
@endsection
