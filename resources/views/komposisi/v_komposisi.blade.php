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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Group OFF
                        </div>
                        <div class="card-body">
                            {{-- tabs --}}
                            <ul class="nav nav-tabs" id="groupOff" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="groupOffA-tab" data-toggle="tab" href="#groupOffA"
                                        role="tab" aria-controls="groupOffA" aria-selected="true">Group A</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="groupOffB-tab" data-toggle="tab" href="#groupOffB"
                                        role="tab" aria-controls="groupOffB" aria-selected="true">Group B</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabGroupOff">
                                <div class="tab-pane fade show active" id="groupOffA" role="tabpanel"
                                    aria-labelledby="groupOffA-tab">
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="tbl table table-bordered table-striped table-sm"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        #
                                                                    </th>
                                                                    <th class="text-center">Nama Karyawan</th>
                                                                    <th class="text-center">Dept/Bagian</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($groupOffA as $key => $a)
                                                                    <tr>
                                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                                        <td>{{ $a->namaKaryawan }}</td>
                                                                        <td class="text-center">{{ $a->departemen->kode }}
                                                                            @if ($a->bagian->kode)
                                                                                /{{ $a->bagian->kode }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="groupOffB" role="tabpanel"
                                    aria-labelledby="groupOffB-tab">
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="tbl table table-bordered table-striped table-sm"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        #
                                                                    </th>
                                                                    <th class="text-center">Nama Karyawan</th>
                                                                    <th class="text-center">Dept/Bagian</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($groupOffB as $key => $b)
                                                                    <tr>
                                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                                        <td>{{ $b->namaKaryawan }}</td>
                                                                        <td class="text-center">{{ $b->departemen->kode }}
                                                                            @if ($b->bagian->kode)
                                                                                /{{ $b->bagian->kode }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- endtabs --}}

                        </div>
                    </div>
                </div>
                {{-- new card --}}
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Group Kerja / Shift
                        </div>
                        <div class="card-body">
                            {{-- tabs --}}
                            <ul class="nav nav-tabs" id="groupKerja" role="tablist">
                                @foreach ($groupKerja as $key => $gk)
                                    <li class="nav-item">
                                        <a class="nav-link @if ($key == 0) active @endif"
                                            id="groupKerjaTab{{ $key }}" data-toggle="tab"
                                            href="#groupKerja{{ $key }}" role="tab"
                                            aria-controls="groupKerja{{ $key }}"
                                            aria-selected="true">{{ $gk->groupKerja }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content" id="myTabGroupKerja">
                                @foreach ($groupKerja as $key => $gk)
                                    <div class="tab-pane fade show @if ($key == 0) active @endif"
                                        id="groupKerja{{ $key }}" role="tabpanel"
                                        aria-labelledby="groupKerja{{ $key }}-tab">
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table class="tbl table table-bordered table-striped table-sm"
                                                                style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            #
                                                                        </th>
                                                                        <th class="text-center">Nama Karyawan</th>
                                                                        <th class="text-center">Dept/Bagian</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $no = 1;
                                                                    @endphp
                                                                    @foreach ($karyawanGroup as $key => $kg)
                                                                        @if ($kg->idGroupKerja == $gk->id)
                                                                            <tr>
                                                                                <td class="text-center">
                                                                                    {{ $no }}
                                                                                </td>
                                                                                <td>{{ $kg->namaKaryawan }}</td>
                                                                                <td class="text-center">
                                                                                    {{ $kg->departemen->kode }}
                                                                                    @if ($kg->bagian->kode)
                                                                                        /{{ $kg->bagian->kode }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                                $no++;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                            {{-- endtabs --}}

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
