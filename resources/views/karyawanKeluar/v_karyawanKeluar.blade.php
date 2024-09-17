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
                <div class="col-lg-5">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="m-0">{{ $title }}</h5>
                        </div> --}}
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="karyawanKeluar/storeData" method="POST">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="idKaryawan"> Nama Karyawan</label>
                                        </div>
                                        <div class="col-md-7">
                                            <select name="idKaryawan" id="idKaryawan"
                                                class="select {{ $errors->has('idKaryawan') ? 'is-invalid' : '' }}"
                                                id="idKaryawan">
                                                <option value="">Pilih Nama Karyawan</option>
                                                @foreach ($karyawan as $k)
                                                    <option value="{{ $k->id }}"
                                                        @if (old('idKaryawan') == $k->id) selected @endif>
                                                        {{ $k->namaKaryawan }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('idKaryawan') }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="tanggalKeluar">Tanggal</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date"
                                                class="form-control {{ $errors->has('tanggalKeluar') ? 'is-invalid' : '' }}"
                                                name="tanggalKeluar" id="tanggalKeluar">
                                            <div class="invalid-feedback">{{ $errors->first('tanggalKeluar') }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="keterangan" id="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                                                rows="3"></textarea>
                                            <div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <input type="hidden" id="idKaryawanKeluar">
                                        <button type="submit" class="btn btn-primary" id="btnSaveData">
                                            <span class="far fa-save" id="load" aria-hidden="true"></span>
                                            Simpan Data</button>
                                        <button type="button" class="btn btn-success d-none" id="btnUpdateData">
                                            <span class="far fa-edit" id="loadUpdate" aria-hidden="true"></span>
                                            Update Data</button>
                                    </div>
                                </form>
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
            $('#listView').load('karyawanKeluar/tabelData')
        });

        let editData = (id, idKaryawan, keterangan, tanggalKeluar) => {
            $('#idKaryawanKeluar').val(id);
            $('#idKaryawan').val(idKaryawan).trigger('change');
            $('#keterangan').val(keterangan);
            $('#tanggalKeluar').val(tanggalKeluar);

            document.getElementById('btnUpdateData').classList.remove('d-none');
            document.getElementById('btnSaveData').classList.add('d-none');
            document.getElementById('showButton').classList.remove('d-none');
        }

        document.getElementById('btnUpdateData').onclick = () => {
            update();
            document.getElementById('btnSaveData').classList.remove('d-none');
            document.getElementById('btnUpdateData').classList.add('d-none');
        }
        document.getElementById('showButton').onclick = () => {
            document.getElementById('btnSaveData').classList.remove('d-none');
            document.getElementById('btnUpdateData').classList.add('d-none');
            document.getElementById('showButton').classList.add('d-none');
        }

        let update = () => {
            let data = {
                '_token': $('#token').val(),
                'id': $('#idKaryawanKeluar').val(),
                'tanggalKeluar': $('#tanggalKeluar').val(),
                'keterangan': $('#keterangan').val(),
                'idKaryawan': $('#idKaryawan').val(),

            }
            $.ajax({
                beforeSend: openLoader('Update Date'),
                type: 'post',
                url: 'karyawanKeluar/updateData',
                data: data,
                success: function() {
                    closeLoader();
                    $('#listView').load('karyawanKeluar/tabelData')
                    document.getElementById('showButton').classList.add('d-none');
                    $('#idKaryawanKeluar').val('');
                    $('#idKaryawan').val('');
                    $('#keterangan').val('');
                    $('#tanggalKeluar').val('');
                    $('.select').selectpicker('refresh')
                    flasher.success('Update Data berhasil')
                },
                error: function() {
                    closeLoader();
                    flasher.error('Server Error');
                }
            })
        }
        let deleteData = (id, nama, idKaryawan) => {
            let token = $('#token').val();
            let dataId = {
                'id': id,
                "_token": token,
                'idKaryawan': idKaryawan
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
                        url: 'karyawanKeluar/delete',
                        data: dataId,
                        success: function() {
                            $('#listView').load('karyawanKeluar/tabelData')
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
