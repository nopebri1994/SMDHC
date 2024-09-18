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
                            <table class="tbl table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th class="text-center">
                                            Tanggal Lembur
                                        </th>
                                        <th class="text-center">
                                            Bagian
                                        </th>
                                        <th class="text-center">
                                            Status Form Lembur
                                        </th>
                                        <th class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overtime as $key => $o)
                                        <tr>
                                            <td class="text-center" style="width:5%">{{ $key + 1 }}</td>
                                            <td class="text-center" style="width:12%">
                                                {{ varHelper::formatDate($o->tanggalOT) }}</td>
                                            <td class="text-center" style="width:12%">{{ $o->bagian->namaBagian }}</td>
                                            <td>
                                                @if (!$o->tanggalAcc)
                                                    <h6>
                                                        <span class="badge badge-danger"> Menunggu Konfirmasi
                                                            Bagian/Departemen</span>
                                                    </h6>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <button class="btn btn-success btn-xs">Konfirmasi Lembur</button> --}}
                                                <button class="btn btn-primary btn-xs">Accept Lembur</button>
                                                <a href="overtime/detail/{{ Crypt::encryptString($o->id) }}"
                                                    class="btn btn-primary btn-xs" target="_blank">Detail
                                                    Lembur</a>
                                                {{-- <button class="btn btn-primary btn-xs">Accept Lembur</button>
                                                <button class="btn btn-danger btn-xs">Cancel Lembur</button> --}}
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            @if (session('status'))
                flasher.success('{{ session('status') }}');
            @endif
        })

        $('.tbl').DataTable({
            responsive: true
        });
    </script>
@endsection
