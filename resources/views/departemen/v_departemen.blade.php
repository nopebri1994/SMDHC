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
                                    <div class="col-md-4">Kode Departemen</div>
                                    <div class="col-md-3">
                                        <input type="text" name="kode" id="kode" placeholder="kode"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">Nama Departemen</div>
                                    <div class="col-md-8">
                                        <input type="text" name="nama" autocomplete="off" id="nama"
                                            placeholder="nama departemen" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">Nama Perusahaan</div>
                                    <div class="col-md-8">
                                        <select name="idPerusahaan" id="idPerusahaan" class="form-control">
                                            @foreach ($perusahaan as $p)
                                                <option value="{{ $p->id }}">{{ $p->namaPerusahaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3" align="right">
                                    <input type="hidden" id="token" value={{ csrf_token() }}>
                                    <input type="hidden" id="idDepartemen">
                                    <input type="hidden" id="tmpKode">
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
            urlPage();
        });

        const load = () => {
            $.ajax({
                type: 'get',
                url: 'departemen/tabelData',
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
            document.getElementById('kode').classList.add('is-invalid');
            document.getElementById('kode').focus();
        }

        let removeInvalid = () => {
            document.getElementById('kode').classList.remove('is-invalid');
            document.getElementById('nama').classList.remove('is-invalid');
        }

        document.getElementById('btnSaveData').onclick = () => {
            let token = $('#token').val();
            let data = {
                'kode': $('#kode').val(),
                'nama': $('#nama').val(),
                'idPerusahaan': $('#idPerusahaan').val(),
                "_token": token,
            };

            $.ajax({
                beforeSend: function() {
                    loadBtnSave();
                },
                type: 'post',
                url: 'departemen/insert',
                data: data,
                success: function(sdata) {
                    $('#kode').val('');
                    $('#nama').val('');
                    let obj = JSON.parse(sdata);
                    flasher.success('Data Berhasil disimpan');
                    removeInvalid();
                    removeBtnSave();
                    load();
                },
                error: function(error) {
                    removeInvalid();
                    //   let notes = error.responseJSON.errors; 
                    //   flasher.error(notes.kode.toString());
                    if (error.responseJSON.errors.kode != undefined) {
                        addInvalid();
                        flasher.error(`${error.responseJSON.errors.kode}`);
                    }
                    if (error.responseJSON.errors.nama != undefined) {
                        document.getElementById('nama').classList.add('is-invalid');
                        flasher.error(`${error.responseJSON.errors.nama}`);
                    }
                    removeBtnSave();
                }
            })
        }

        let deleteData = (id, kode) => {
            let token = $('#token').val();
            let dataId = {
                'id': id,
                "_token": token,
            };
            Swal.fire({
                title: "Do you want to delete kode " + kode + "?",
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
                        url: 'departemen/delete',
                        data: dataId,
                        success: function() {
                            $('#kode').val('');
                            $('#nama').val('');
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

        let editData = (kode, nama, id, idPerusahaan) => {
            $('#kode').val(kode);
            $('#tmpKode').val(kode);
            $('#nama').val(nama);
            $('#idDepartemen').val(id);
            document.getElementById("idPerusahaan").value = idPerusahaan;
            document.getElementById('btnUpdateData').classList.remove('d-none');
            document.getElementById('btnSaveData').classList.add('d-none');
            document.getElementById('showButton').classList.remove('d-none');
        }

        document.getElementById('showButton').onclick = () => {
            showButton();
        }

        let showButton = () => {
            $('#kode').val('');
            $('#tmpKode').val('');
            $('#nama').val('');
            $('#idDepartemen').val('');
            document.getElementById('btnSaveData').classList.remove('d-none');
            document.getElementById('btnUpdateData').classList.add('d-none');
            document.getElementById('showButton').classList.add('d-none');
        }

        document.getElementById('btnUpdateData').onclick = () => {
            let token = $('#token').val();
            let data = {
                'id': $('#idDepartemen').val(),
                'kode': $('#kode').val(),
                'nama': $('#nama').val(),
                'idPerusahaan': $('#idPerusahaan').val(),
                "_token": token,
                'tmpKode': $('#tmpKode').val(),
            };

            $.ajax({
                beforeSend: function() {
                    loadBtnUpdate();
                },
                type: 'post',
                url: 'departemen/update',
                data: data,
                success: function(sdata) {
                    $('#kode').val('');
                    $('#nama').val('');
                    flasher.success('Data Berhasil diperbarui');
                    removeBtnUpdate();
                    removeInvalid();
                    showButton();
                    load();
                },
                error: function(error) {
                    addInvalid();
                    removeBtnUpdate();
                    flasher.error(`${error.responseJSON.errors.kode}`);
                }
            })
        }

        //pagination ajax
        const urlPage = () => {
            $(window).on('hashchange', function() {
                if (window.location.hash) {
                    let page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    } else {
                        getData(page);
                    }
                }
            });
        }

        $(document).on('click', '.pagination a', function(event) {
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            event.preventDefault();

            // let myurl = $(this).attr('href');
            let page = $(this).attr('href').split('page=')[1];
            getData(page);
        });

        const getData = (page) => {
            $.ajax({
                    url: "departemen/tabelData?page=" + page,
                    type: "get",
                    datatype: "html",
                })
                .done(function(data) {
                    $("#listView").empty().html(data);
                    location.hash = page;
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    flasher.error("Oops! Something went wrong!");
                });
        }
        //end pagination
    </script>
@endsection
