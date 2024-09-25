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
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}/pay/overtime">Overtime</a></li>
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
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <input type="hidden" name="_token" id="token"
                                                value="{{ csrf_token() }}" />
                                            <input type="hidden" name="tgl" id="tgl"
                                                value="{{ $form->tanggalOT }}" />
                                            <div class="col-md-4 col-5"><b>Hari, Tanggal Lembur</b></div>
                                            <div class="col-md-3 col-6">
                                                {{ varHelper::hariIndo(date('l', strtotime($form->tanggalOT))) }},
                                                {{ varHelper::formatDate($form->tanggalOT) }}
                                            </div>
                                            <input type="hidden" value="{{ Crypt::encryptString($form->id) }}"
                                                id="idForm">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-5"><b>Bagian</b></div>
                                            <div class="col-md-6 col-6">{{ $form->bagian->namaBagian }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 pt-1"" align="right">
                                                <a href="{{ URL::to('/') }}/pay/overtime" class="btn btn-danger"><i
                                                        class="fas fa-backward"></i>
                                                    Back</a>
                                            </div>
                                            <div class="col-md-4 pt-1">
                                                <button class="btn btn-primary btn-block" id="btnCetak"><span
                                                        class="fas fa-print"></span>&nbsp;Print
                                                    Form Lembur</button>
                                            </div>
                                            @can('itAdmin')
                                                <div class="col-md-4 pt-1" align="left">
                                                    <button class="btn btn-info btn-block" id="tambahData" data-toggle="modal"
                                                        data-target="#tambahDataModal"
                                                        @if ($form->tanggalAcc) disabled @endif><span
                                                            class="fas fa-plus"></span>&nbsp;Tambah Data</button>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="list"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal TambahData-->
    <div class="modal fade" id="tambahDataModal" role="dialog" aria-labelledby="tambahDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambah">Tambah Data Lembur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="namaKaryawan">Nama Karyawan</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="namaKaryawan" id="namaKaryawan" class="select">
                                        @foreach ($karyawan as $k)
                                            <option value="{{ $k->id }}">
                                                {{ $k->namaKaryawan }} ({{ $k->nikKerja }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <label for="jamMulai">Jam Mulai OT</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" name="jamMulai" class="form-control" id="jamMulai">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <label for="jamOT">Total Jam OT</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" max="7" name="jamOT" id="jamOT"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <label for="jp">Jenis Pekerjaan</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="jp" id="jp" cols="5" rows="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSaveModal"> <span
                            class="fa fa-save"></span>&nbsp; Save
                        Data</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <!-- Modal TambahData-->
    <div class="modal fade" id="editDataModal" role="dialog" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaledit">Edit Data Lembur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="editnamaKaryawan">Nama Karyawan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="editid" id="editid" class="form-control">
                                    <input type="text" name="editnamaKaryawan" id="editnamaKaryawan"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <label for="editjamMulai">Jam Mulai OT</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="time" name="editjamMulai" class="form-control" id="editjamMulai">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <label for="editjamOT">Total Jam OT</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" max="7" name="editjamOT" id="editjamOT"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4">
                                    <label for="editjp">Jenis Pekerjaan</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="editjp" id="editjp" cols="5" rows="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnUpdateModal"> <span
                            class="fa fa-edit"></span>&nbsp; Update
                        Data</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            load();
        });
        document.getElementById('btnCetak').onclick = () => {
            let id = $('#idForm').val();
            window.open("../cetakLaporan/" + id);
        }

        const load = () => {
            let id = $('#idForm').val();
            let data = {
                'id': id
            }
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'get',
                url: '../tabelDetail',
                data: data,
                success: function(sdata) {
                    $('#list').html(sdata);
                    closeLoader();
                },
                error: function(error) {
                    flasher.error('data not found');
                    closeLoader();
                }
            })
        }

        let updateStatus = (a, b) => {
            update(a, b)
        }
        let update = (a, b) => {
            data = {
                'id': a,
                'status': b,
            }
            $.ajax({
                type: 'get',
                url: '../updateStatus',
                data: data,
                success: function(sdata) {
                    flasher.success('Status Updated')
                    load();
                },
                error: function(error) {
                    flasher.error('Server Error')
                }
            })
        }

        document.getElementById("btnSaveModal").onclick = () => {
            let id = $('#idForm').val();
            let tgl = $('#tgl').val();
            let nama = $('#namaKaryawan').val();
            let jamMulai = $('#jamMulai').val();
            let jamOT = $('#jamOT').val();
            let jp = $('#jp').val();
            let token = $('#token').val();

            if (jamOT == '' || jamMulai == '') {
                flasher.error('Cek input form');
                return;
            }
            if (jamOT > 7) {
                flasher.error('Jam OT maksimal 7 jam');
                return;
            }

            let data = {
                'idForm': id,
                'idKaryawan': nama,
                'jamMulai': jamMulai,
                'jamOT': jamOT,
                'jp': jp,
                'tgl': tgl,
                "_token": token,
            };

            $.ajax({
                type: 'post',
                url: '../storeDetail',
                data: data,
                success: function(sdata) {
                    if (sdata['error'] == '') {
                        flasher.success(sdata['success'])
                        load();
                        $('#tambahDataModal').modal('toggle');
                    } else {
                        flasher.error(sdata['error'])
                    }

                },
                error: function(error) {
                    flasher.error('Server Error')
                }
            })
        }

        let edit = (nama, jm, jOT, jp, id) => {
            $('#editnamaKaryawan').val(nama);
            $('#editjamMulai').val(jm);
            $('#editjamOT').val(jOT);
            $('#editjp').val(jp);
            $('#editid').val(id);

        }

        document.getElementById("btnUpdateModal").onclick = () => {
            let id = $('#editid').val();
            let jamMulai = $('#editjamMulai').val();
            let jamOT = $('#editjamOT').val();
            let jp = $('#editjp').val();
            let token = $('#token').val();
            let tgl = $('#tgl').val();

            if (jamOT == '' || jamMulai == '') {
                flasher.error('Cek input form');
                return;
            }
            if (jamOT > 7) {
                flasher.error('Jam OT maksimal 7 jam');
                return;
            }

            let data = {
                'idDetail': id,
                'jamMulai': jamMulai,
                'jamOT': jamOT,
                'jp': jp,
                'tgl': tgl,
                "_token": token,
            };

            $.ajax({
                type: 'post',
                url: '../updateDetail',
                data: data,
                success: function(sdata) {
                    if (sdata['error'] == '') {
                        flasher.success(sdata['success'])
                        load();
                        $('#editDataModal').modal('toggle');
                    } else {
                        flasher.error(sdata['error'])
                    }

                },
                error: function(error) {
                    flasher.error('Server Error')
                }
            })
        }
    </script>
@endsection
