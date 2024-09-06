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
                            <form action="kontrak-karyawan/store" method="POST" id="upload"
                                enctype="multipart/form-data">
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
                                                            {{ $k->namaKaryawan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="noKontrak">No. Kontrak</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" placeholder="001/LMWP/......." class="form-control"
                                                    name="noKontrak" id="noKontrak" required>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="kontrakKe">Kontrak Ke</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="kontrakKe" class="form-control" id="kontrakKe">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label>Upload PKWT</label>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input"
                                                        id="fileUpload" accept="application/pdf" required>
                                                    <label class="custom-file-label" for="fileUpload">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="dibuatTanggal">Tanggal Dibuat</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="date" class="form-control" name="dibuatTanggal"
                                                    id="dibuatTanggal" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="berlakuTanggal">Berlaku Tanggal</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="date" class="form-control" name="berlakuTanggal"
                                                    id="berlakuTanggal" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <label for="sampaiTanggal">Sampai Tanggal</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="date" class="form-control" name="sampaiTanggal"
                                                    id="sampaiTanggal" required>
                                            </div>
                                        </div>
                                        <div class="mt-3" align="right">
                                            <input type="hidden" name="id" id="id">
                                            <button type="submit" class="btn btn-primary" id="btnSaveData">
                                                <span class="far fa-save" id="load" aria-hidden="true"></span>
                                                Simpan Data</button>
                                            <button type="button" class="btn btn-danger d-none" id="btnCancel">
                                                cancel Data</button>
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
                                <div class="col-md-1">
                                    <label for="idKaryawan2">Filter</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="idKaryawan2" id="idKaryawan2" class="select" data-live-search="true"
                                        data-show-subtext="true" required>
                                        <option value="0">Pilih Nama Karyawan</option>
                                        @foreach ($karyawan as $k)
                                            <option value="{{ $k->id }}">
                                                {{ $k->namaKaryawan }}</option>
                                        @endforeach
                                    </select>
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
    <script>
        $(document).ready(function() {
            loadData();
        });

        document.getElementById('idKaryawan2').onchange = () => {
            loadData();
        }

        let loadData = () => {
            let id = $('#idKaryawan2').val();
            let data = {
                'id': id,
            }
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'get',
                url: 'kontrak-karyawan/tabelData',
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
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
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
                                $('.progress .progress-bar').css("width", percentage +
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
                                $('.progress .progress-bar').css("width", percentage +
                                    '%')
                                $('.progress').addClass('d-none')
                                $('#fileUpload').val('');
                                $('#idKaryawan').val('').trigger('change');
                                $('#noKontrak').val('');
                                $('#dibuatTanggal').val('');
                                $('#berlakuTanggal').val('');
                                $('#sampaiTanggal').val('');
                                $('#kontrakKe').val('1');
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



        $('#fileUpload').on('change', function() {
            //get the file name
            let fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })

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
                        url: 'kontrak-karyawan/delete',
                        data: dataId,
                        success: function() {
                            $('#list').load('kontrak-karyawan/tabelData')
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

        let editData = (id, nokontrak, kontrakke, berlaku, sampai, dibuat, idKaryawan) => {
            $('#cardForm').CardWidget('toggle')
            let action = 'kontrak-karyawan/update'
            $('#id').val(id)
            $('#idKaryawan').val(idKaryawan).trigger('change');
            $('#noKontrak').val(nokontrak);
            $('#dibuatTanggal').val(dibuat);
            $('#berlakuTanggal').val(berlaku);
            $('#sampaiTanggal').val(sampai);
            $('#kontrakKe').val(kontrakke);
            document.getElementById('btnSaveData').classList.add('d-none')
            document.getElementById('btnUpdateData').classList.remove('d-none')
            document.getElementById('btnCancel').classList.remove('d-none')
            document.getElementById('upload').action = action
            document.getElementById("fileUpload").required = false;
        }

        let btnCancel = () => {
            $('#cardForm').CardWidget('toggle')
            let action = 'kontrak-karyawan/store'
            $('#fileUpload').val('');
            $('#idKaryawan').val('');
            $('#noKontrak').val('');
            $('#dibuatTanggal').val('');
            $('#berlakuTanggal').val('');
            $('#sampaiTanggal').val('');
            $('#kontrakKe').val('1');
            document.getElementById('btnSaveData').classList.remove('d-none')
            document.getElementById('btnUpdateData').classList.add('d-none')
            document.getElementById('btnCancel').classList.add('d-none')
            document.getElementById("fileUpload").required = true;
            document.getElementById('upload').action = action
        }

        document.getElementById('btnCancel').onclick = () => {
            btnCancel();
        }
    </script>
@endsection
