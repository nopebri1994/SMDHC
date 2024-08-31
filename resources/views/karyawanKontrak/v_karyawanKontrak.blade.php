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
                    <div class="card">
                        <div class="card-header">
                            {{-- progres Bar --}}
                            <div class="alert alert-success success__msg bg-light" style="display: none; color: white;"
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
                                                    data-live-search="true" data-show-subtext="true" id="idKaryawan"
                                                    required>
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
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
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
                                                        id="fileUpload" required>
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
                                            <input type="hidden" id="id">
                                            <button type="submit" class="btn btn-primary" id="btnSaveData">
                                                <span class="far fa-save" id="load" aria-hidden="true"></span>
                                                Simpan Data</button>
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
            $('#list').load('kontrak-karyawan/tabelData')
            $('.select').selectpicker({
                style: "bg-info",
            });
        });

        //progres with ajaxFOrm
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
                        console.log(xhr['responseJSON']['error']);
                        if (xhr['responseJSON']['error'] != '') {
                            message.fadeIn().removeClass('alert-success').addClass(
                                'alert-danger');
                            message.text("Data and Uploaded Failed.");
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
                            message.text("Data and Uploaded File successfully.");
                            setTimeout(function() {
                                message.fadeOut();
                                percentage = '0';
                                elem.innerHTML = percentage
                                $('.progress .progress-bar').css("width", percentage +
                                    '%')
                                $('.progress').addClass('d-none')
                                $('#fileUpload').val('');
                                $('#idKaryawan').val('');
                                $('#noKontrak').val('');
                                $('#dibuatTanggal').val('');
                                $('#berlakuTanggal').val('');
                                $('#sampaiTanggal').val('');
                                $('#kontrakKe').val('1');
                                $('.custom-file-label').html('Choose file');
                            }, 2000);
                            $('#list').load('kontrak-karyawan/tabelData')
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
    </script>
@endsection
