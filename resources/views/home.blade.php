@extends('_main/main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Halaman Depan</h1> --}}
                </div>
                {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">..</a></li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @can('hc')
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="info-box mb-3 bg-warning">
                                        <span class="info-box-icon"><i class="fas fa-user-tag"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">PKWT Jatuh Tempo</span>
                                            <span class="info-box-number">{{ $pkwt }} Orang</span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box mb-3 bg-primary">
                                        <span class="info-box-icon"><i class="fas fa-user-tag"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Surat Peringatan Selesai</span>
                                            <span class="info-box-number">{{ $sp }} Orang</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <div class="col-lg-12">
                        <div class="card">
                            {{-- <div class="card-header">
                            <h5 class="m-0"></h5>
                        </div> --}}
                            <div class="card-body">
                                <div class="row">
                                    {{-- badge --}}
                                    <div class="col-lg-3 col-12">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>{{ $countEmployee }}</h3>
                                                <p>Total Karyawan</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-people-carry"></i>
                                            </div>
                                            <a href="{{ URL::to('/dk/karyawan') }}" class="small-box-footer">More info <i
                                                    class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                        {{-- detail karyawan perusahaan --}}
                                        <div class="info-box bg-orange">
                                            <span class="info-box-icon" style="color:#fff"><i
                                                    class="fas fa-user-circle"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text" style="color: #fff">PT Lion Metal Works
                                                    Tbk</span>
                                                <span class="info-box-number" style="color:#fff">{{ $metalEmployee }}</span>
                                                <div class="progress">
                                                    <div class="progress-bar"
                                                        style="width: {{ number_format(($metalEmployee / $countEmployee) * 100, 0, ',', '') }}%">
                                                    </div>
                                                </div>
                                                <span class="progress-description" style="color: #fff">
                                                    {{ number_format(($metalEmployee / $countEmployee) * 100, 2, ',', '') }}%
                                                </span>
                                            </div>
                                        </div>
                                        <div class="info-box bg-success">
                                            <span class="info-box-icon"><i class="fas fa-user-circle"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text" style="color: #fff">PT Singa Purwakarta
                                                    Jaya</span>
                                                <span class="info-box-number"
                                                    style="color:#fff">{{ $countEmployee - $metalEmployee }}</span>
                                                <div class="progress">
                                                    <div class="progress-bar"
                                                        style="width: {{ number_format((($countEmployee - $metalEmployee) / $countEmployee) * 100, 0, ',', '') }}%">
                                                    </div>
                                                </div>
                                                <span class="progress-description" style="color: #fff">
                                                    {{ number_format((($countEmployee - $metalEmployee) / $countEmployee) * 100, 2, ',', '') }}%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- donut chart --}}
                                    <div class="col-lg-9 col-12">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title">Komposisi Karyawan Bagian PT Lion Metal Works</h3>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="donutChart"
                                                    style="min-height: 250px; height: 310px; max-height: 400px; max-width: 100%;"></canvas>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- badge --}}
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::to('/') }}/assets/adminlte/js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('status'))
                flasher.success('{{ session('status') }}');
            @endif
        })

        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                @foreach ($metalC as $mc)
                    '{{ $mc->namaBagian }} ({{ $mc->total }})',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach ($metalC as $mc)
                        {{ $mc->total }},
                    @endforeach
                ],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#45b39d', '#FD7E14',
                    '#343A40', '#8338EC', '#CD5C5C', '#424949', '#f5b041', '#d35400', '#154360', '#784212',
                    '#138d75', '#283747', '#f0b27a'
                ],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
@endsection
