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
                                <form action="jadwalGroupKerja/storeData" method="POST">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="group">Group Kerja</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="group" id="group" class="form-control">
                                                @foreach ($groupKerja as $g)
                                                    <option value="{{ $g->id }}">{{ $g->groupKerja }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="jam">Jam Kerja</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="jam" id="jam" class="form-control">
                                                @foreach ($jamKerja as $j)
                                                    <option value="{{ $j->id }}">{{ $j->kodeJamKerja }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="dariTanggal">Dari Tanggal</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date"
                                                class="form-control {{ $errors->has('dariTanggal') ? 'is-invalid' : '' }}"
                                                name="dariTanggal" id="dariTanggal" required>
                                            <div class="invalid-feedback">{{ $errors->first('dariTanggal') }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="sampaiTanggal">Sampai Tanggal</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="date"
                                                class="form-control {{ $errors->has('sampaiTanggal') ? 'is-invalid' : '' }}"
                                                name="sampaiTanggal" id="sampaiTanggal" required>
                                            <div class="invalid-feedback">{{ $errors->first('sampaiTanggal') }}</div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <label for="sampaiTanggal">Anggota Security</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="sct" id="sct" class="form-control">
                                                <option value="0">Bukan</option>
                                                <option value="1">Ya</option>
                                            </select>
                                            <div class="invalid-feedback">{{ $errors->first('sampaiTanggal') }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-3" align="right">
                                        <button type="submit" class="btn btn-primary" id="btnSaveData">
                                            <span class="far fa-save" id="load" aria-hidden="true"></span>
                                            Simpan Data</button>
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
            $('#listView').load('jadwalGroupKerja/tabelData')
            @if (session('status'))
                flasher.success('{{ session('status') }}');
            @endif
        });


        let deleteData = (id, group) => {
            let token = $('#token').val();
            let dataId = {
                'id': id,
                "_token": token,
            };
            Swal.fire({
                title: "Do you want to delete field " + group + "?",
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
                        url: 'jadwalGroupKerja/delete',
                        data: dataId,
                        success: function() {
                            $('#listView').load('jadwalGroupKerja/tabelData')
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
