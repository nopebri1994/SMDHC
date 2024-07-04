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
                            <h5 class="m-0">{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">Tanggal Libur</div>
                                    <div class="col-md-6">
                                        <input type="date" name="tanggalLibur" id="tanggalLibur" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">Keterangan</div>
                                    <div class="col-md-9">
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="mt-3" align="right">
                                    <input type="hidden" id="token" value={{ csrf_token() }}>
                                    <input type="hidden" id="idLibur">
                                    <button type="button" class="btn btn-primary" id="btnSaveData">
                                        <span class="far fa-save" id="load" aria-hidden="true"></span>
                                        Simpan Data</button>
                                    <button type="button" class="btn btn-success d-none" id="btnUpdateData">
                                        <span class="far fa-edit" id="loadUpdate" aria-hidden="true"></span>
                                        Update Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-info d-none mb-2" id="showButton">
                                    <span class="far fa-plus" aria-hidden="true"></span> Add Data</button>
                            </div>
                            <div class="text-center" id="spin">
                                <div class="spinner-grow text-info m-5" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="table-responsive" id="listView"></div>
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
            load();
        });

        const load = () => {
            $.ajax({
                type: 'get',
                url: 'libur/tabelData',
                success: function(sdata) {
                    $('#listView').html(sdata);
                    document.getElementById('spin').style.display = 'none';
                },
                error: function(error) {
                    alert('data not found');
                    document.getElementById('spin').style.display = 'none';
                }
            })
        }

        let loadBtnSave = () => {
            let x = document.getElementById('load');
            x.classList.remove('far', 'fa-save');
            x.classList.add('spinner-border', 'spinner-border-sm');
            document.getElementById('btnSaveData').disabled = true;
        }

        let removeBtnSave = () => {
            let x = document.getElementById('load');
            x.classList.remove('spinner-border', 'spinner-border-sm');
            x.classList.add('far', 'fa-save');
            document.getElementById('btnSaveData').disabled = false;
        }

        let loadBtnUpdate = () => {
            let y = document.getElementById('loadUpdate');
            y.classList.remove('far', 'fa-edit');
            y.classList.add('spinner-border', 'spinner-border-sm');
            document.getElementById('btnUpdateData').disabled = true;
        }

        let removeBtnUpdate = () => {
            let y = document.getElementById('loadUpdate');
            y.classList.add('far', 'fa-edit');
            y.classList.remove('spinner-border', 'spinner-border-sm');
            document.getElementById('btnUpdateData').disabled = false;

        }

        let addInvalid = () => {
            document.getElementById('tanggalLibur').classList.add('is-invalid');
            document.getElementById('tanggalLibur').focus();
        }

        let removeInvalid = () => {
            document.getElementById('tanggalLibur').classList.remove('is-invalid');
            document.getElementById('keterangan').classList.remove('is-invalid');
        }

        document.getElementById('btnSaveData').onclick = () => {
            let token = $('#token').val();
            let data = {
                'tanggalLibur': $('#tanggalLibur').val(),
                'keterangan': $('#keterangan').val(),
                "_token": token,
            };

            $.ajax({
                beforeSend: function() {
                    loadBtnSave();
                },
                type: 'post',
                url: 'libur/insert',
                data: data,
                success: function(sdata) {
                    $('tanggalLibur').val('');
                    $('#keterangan').val('');
                    let obj = JSON.parse(sdata);
                    flasher.success('Data Berhasil disimpan');
                    removeInvalid();
                    removeBtnSave();
                    load();
                },
                error: function(error) {
                    removeInvalid();
                    if (error.responseJSON.errors.tanggalLibur != undefined) {
                        addInvalid();
                        flasher.error(`${error.responseJSON.errors.tanggalLibur}`);
                    }
                    if (error.responseJSON.errors.keterangan != undefined) {
                        document.getElementById('keterangan').classList.add('is-invalid');
                        flasher.error(`${error.responseJSON.errors.keterangan}`);
                    }
                    removeBtnSave();
                }
            })
        }

        let deleteData = (id, tanggalLibur) => {
            let token = $('#token').val();
            let dataId = {
                'id': id,
                "_token": token,
            };
            Swal.fire({
                title: "Do you want to delete Tanggal Libur " + tanggalLibur + "?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Delete",
                denyButtonText: `Cancel`,
                denyButtonColor: `#636363`,
                confirmButtonColor: '#ff2c2c',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: 'libur/delete',
                        data: dataId,
                        success: function() {
                            load();
                            showButton();
                            flasher.success('Data Berhasil dihapus')
                        },
                        error: function() {
                            showButton();
                            flasher.error('Data Gagal dihapus')
                        }

                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        }

        let editData = (tanggalLibur, keterangan, id) => {
            $('#tanggalLibur').val(tanggalLibur);
            $('#keterangan').val(keterangan);
            $('#idLibur').val(id);
            document.getElementById('btnUpdateData').classList.remove('d-none');
            document.getElementById('btnSaveData').classList.add('d-none');
            document.getElementById('showButton').classList.remove('d-none');
        }

        document.getElementById('showButton').onclick = () => {
            showButton();
        }

        let showButton = () => {
            $('#tanggalLibur').val('');
            $('#keterangan').val('');
            $('#idLibur').val('');
            document.getElementById('btnSaveData').classList.remove('d-none');
            document.getElementById('btnUpdateData').classList.add('d-none');
            document.getElementById('showButton').classList.add('d-none');
        }

        document.getElementById('btnUpdateData').onclick = () => {
            let token = $('#token').val();
            let data = {
                'id': $('#idLibur').val(),
                'tanggalLibur': $('#tanggalLibur').val(),
                'keterangan': $('#keterangan').val(),
                "_token": token,
            };

            $.ajax({
                beforeSend: function() {
                    loadBtnUpdate();
                },
                type: 'post',
                url: 'libur/update',
                data: data,
                success: function(sdata) {
                    $('#tanggalLibur').val('');
                    $('#keterangan').val('');
                    $('#idLibur').val('')
                    flasher.success('Data Berhasil diperbarui');
                    removeBtnUpdate();
                    removeInvalid();
                    showButton();
                    load();
                },
                error: function(error) {
                    addInvalid();
                    removeBtnUpdate();
                    flasher.error(`${error.responseJSON.errors.tanggalLibur}`);
                }
            })
        }
    </script>
@endsection
