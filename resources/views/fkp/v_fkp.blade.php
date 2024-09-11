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
                            <div class="col-12" align="right">
                                <a href="fkp/addData" class="btn btn-primary btn-sm"><span
                                        class="fas fa-plus"></span>&nbsp;Tambah
                                    Data Pelatihan</a>
                            </div>

                        </div>
                        <div class="card-body">
                            <table class="tbl table table-bordered table striped display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama Karyawan</th>
                                        <th class="text-center">Type Pelatihan</th>
                                        <th class="text-center">Jenis Pelatihan</th>
                                        <th class="text-center">Tgl. Mulai</th>
                                        <th class="text-center">Tgl. Selesai</th>
                                        <th class="text-center">FKP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $date = date('Y-m-d');
                                    @endphp
                                    @foreach ($data as $key => $d)
                                        @php
                                            $notifikasi = date(
                                                'Y-m-d',
                                                strtotime('-31 days', strtotime($d->tglSelesai)),
                                            );
                                        @endphp
                                        <tr @if ($notifikasi < $date) style="background-color: #62B8C5" @endif>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $d->karyawan->nikKerja }}</td>
                                            <td>{{ $d->karyawan->namaKaryawan }}</td>
                                            <td>
                                                @if ($d->typePelatihan == '0')
                                                    {{ $d->typeLain }}
                                                @else
                                                    {{ varHelper::typePelatihan($d->typePelatihan) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->jenisPelatihan == '0')
                                                    {{ $d->jenisLain }}
                                                @else
                                                    {{ varHelper::jenisPelatihan($d->jenisPelatihan) }}
                                                @endif
                                            </td>

                                            <td class="text-center">{{ varHelper::formatDate($d->tglMulai) }}</td>
                                            <td class="text-center">{{ varHelper::formatDate($d->tglSelesai) }}</td>
                                            <td class="text-center"> <a
                                                    href="{{ URL::to('storage/fkp/') }}/{{ $d->file }}"
                                                    class="link" target="_blank">
                                                    File PKWT</a></td>
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
