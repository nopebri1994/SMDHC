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
                        <li class="breadcrumb-item">overtime</li>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="tglAwal" class="pt-2">
                                                Periode Lembur
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="date" class="form-control" name="tglAwal" id="tglAwal">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="date" class="form-control" name="tglAkhir" id="tglAkhir">
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-info btn-block" id="btnKalkulasi">Kalkulasi Data</button>
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

    <!-- Modal GetDetail-->
    <div class="modal fade" id="detailModal" role="dialog" aria-labelledby="detailModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDetail">Detail Data Lembur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="detailData" class="col-12"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
@endsection
@section('js')
    <script>
        document.getElementById('btnKalkulasi').onclick = () => {
            let awal = $('#tglAwal').val();
            let akhir = $('#tglAkhir').val();

            if (awal == '' || akhir == '' || awal > akhir) {
                flasher.error('Cek Input Data Periode');
                return;
            }

            let data = {
                'awal': awal,
                'akhir': akhir
            }

            $.ajax({
                type: 'get',
                url: 'tabelKalkulasi',
                data: data,
                success: function(sdata) {
                    $('#list').html(sdata);
                },
                error: function(error) {
                    flasher.error('Server Error')
                }
            })
        }

        let getLemburDetail = (a) => {
            let awal = $('#tglAwal').val();
            let akhir = $('#tglAkhir').val();

            if (awal == '' || akhir == '' || awal > akhir) {
                flasher.error('Cek Input Data Periode');
                return;
            }

            let data = {
                'awal': awal,
                'akhir': akhir,
                'id': a
            }

            $.ajax({
                type: 'get',
                url: 'detailKalkulasi',
                data: data,
                success: function(sdata) {
                    $('#detailData').html(sdata);
                },
                error: function(error) {
                    flasher.error('Server Error')
                }
            })

        }
    </script>
@endsection
