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
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12" align="right">
                                <a href="overtime/addData" class="btn btn-primary btn-sm"><span
                                        class="fas fa-plus"></span>&nbsp;Tambah
                                    Data Overtime</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                            <div id="list"></div>
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
            @if (session('status'))
                flasher.success('{{ session('status') }}');
            @endif
        })

        const load = () => {
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'get',
                url: 'overtime/tabelData',
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

        let accept = (a) => {
            let token = $('#token').val();
            let dataId = {
                'id': a,
                "_token": token,
            };
            Swal.fire({
                title: "Konfirmasi Data Lembur ?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Yes",
                denyButtonText: `Cancel`,
                denyButtonColor: `#636363`,
                confirmButtonColor: '#24943D',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        beforeSend: openLoader('memuat data'),
                        type: 'post',
                        url: 'overtime/updateStatusForm',
                        data: dataId,
                        success: function(sdata) {
                            load();
                            if (sdata['error'] == '') {
                                flasher.success(sdata['success'])
                            } else {
                                flasher.error(sdata['error'])
                            }
                            closeLoader();
                        },
                        error: function() {
                            flasher.error('Data gagal dikonfirmasi')
                            closeLoader();

                        }

                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        }

        let confirm = (a) => {
            let token = $('#token').val();
            let dataId = {
                'id': a,
                "_token": token,
            };
            Swal.fire({
                title: "Terima Form Lembur ?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Yes",
                denyButtonText: `Cancel`,
                denyButtonColor: `#636363`,
                confirmButtonColor: '#24943D',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        beforeSend: openLoader('memuat data'),
                        type: 'post',
                        url: 'overtime/updateStatusFormHC',
                        data: dataId,
                        success: function() {
                            load();
                            flasher.success('Form berhasil diterima')
                            closeLoader();
                        },
                        error: function() {
                            flasher.error('Data gagal diterima')
                            closeLoader();

                        }

                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        }

        let reject = (a) => {
            let token = $('#token').val();
            let dataId = {
                'id': a,
                "_token": token,
            };
            Swal.fire({
                title: "Tolak Form Lembur ?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Yes",
                denyButtonText: `Cancel`,
                denyButtonColor: `#636363`,
                confirmButtonColor: '#DC3545',
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        beforeSend: openLoader('memuat data'),
                        type: 'post',
                        url: 'overtime/updateStatusFormReject',
                        data: dataId,
                        success: function(sdata) {
                            load();
                            flasher.success('Status Updated')
                            closeLoader();
                        },
                        error: function() {
                            flasher.error('Data gagal ditolak')
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
