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
                                        <div class="row pt-1">
                                            <div class="col-md-6">
                                                &nbsp;
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-block" id="btnCetak"><span
                                                        class="fas fa-print"></span>&nbsp;Print
                                                    Form Lembur</button>
                                            </div>
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
    </script>
@endsection
