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
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            Tunjangan
                        </div>
                        <div class="card-body">
                            {{-- isi body --}}
                            <i>GP = Gaji Pokok</i>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="gpKontrak" class="pt-2">GP Karyawan Kontrak</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="gpKontrak">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="tjMakan" class="pt-2">Tunj. Makan</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="tjMakan">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label for="tjTransport" class="pt-2">Tunj. Transport</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="tjTransport">
                                </div>
                            </div>
                            {{-- end body --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            Potongan
                        </div>
                        <div class="card-body">
                            {{-- isi body --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="gpKontrak" class="pt-2">Potongan BPJS Kes.</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ptBpjsKes" id="ptBpjsKes1"
                                            value="Persen" checked>
                                        <label class="form-check-label" for="ptBpjsKes1">By. Persen</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ptBpjsKes" id="ptBpjsKes2"
                                            value="Nominal">
                                        <label class="form-check-label" for="ptBpjsKes2">By. Nominal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                            </div>
                                            <input type="text" class="form-control" id="ptBpjsKesPersen">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp.</div>
                                            </div>
                                            <input type="text" class="form-control" id="ptBpjsKesNominal" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div align="right">
                                        <button type="submit" class="btn btn-success"><span
                                                class="fas fa-save"></span>&nbsp;&nbsp;Save Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- end body --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.tbl').DataTable({
            responsive: true
        });
    </script>
@endsection
