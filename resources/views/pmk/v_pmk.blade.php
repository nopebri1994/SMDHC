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
                        <li class="breadcrumb-item">Personalia</li>
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
                            <button class="btn btn-outline-primary" onclick="loadData()">Data PMK ALL</button>
                            <button class="btn btn-outline-primary" onclick="loadData2()">Data yang akan mendapatkan
                                PMK</button>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div id="list"></div>
                            </div>
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
            loadData2();
        });

        let loadData = () => {
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'Get',
                url: 'pmk/tabelData',
                success: function(html) {
                    $('#list').html(html)
                    closeLoader();
                },
                error: function() {
                    closeLoader();
                }
            })
        }

        let loadData2 = () => {
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'Get',
                url: 'pmk/tabelDataHak',
                success: function(html) {
                    $('#list').html(html)
                    closeLoader();
                },
                error: function() {
                    closeLoader();
                }
            })
        }
    </script>
@endsection
