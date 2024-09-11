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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script></script>
@endsection
