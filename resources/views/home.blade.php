@extends('_main/main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Halaman Depan</h1> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">..</a></li>
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
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box bg-orange">
                                        <span class="info-box-icon" style="color:#fff"><i
                                                class="fas fa-user-circle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text" style="color: #fff">PT Lion Metal Works Tbk</span>
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
                                            <span class="info-box-text" style="color: #fff">PT Singa Purwakarta Jaya</span>
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
    <script>
        $(document).ready(function() {
            @if (session('status'))
                flasher.success('{{ session('status') }}');
            @endif
        })
    </script>
@endsection
