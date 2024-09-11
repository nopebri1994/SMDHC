<style type="text/css">
    table>thead>tr>th {
        text-align: center;
        height: 3rem;
    }

    .dt-search {
        padding-bottom: 10px;
    }

    .dt-paging {
        padding-top: 10px;
    }
</style>
<table class="table table-bordered table-sm table-striped shadow display nowrap" style="width: 100%" id="tbl">
    <thead>
        <tr>
            <th class="align-middle  text-center">#</th>
            <th class="align-middle text-center">Nama Karyawan</th>
            <th class="align-middle  text-center">Dept / Bagian</th>
            <th class="align-middle  text-center">Nomor Kontrak</th>
            <th class="align-middle  text-center">Kontrak Ke</th>
            <th class="align-middle  text-center">Berlaku Tanggal</th>
            <th class="align-middle  text-center">sampai Tanggal</th>
            <th class="align-middle  text-center">File Kontrak</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php
            $date = date('Y-m-d');
        @endphp
        @foreach ($data as $key => $d)
            @php
                $notifikasi = date('Y-m-d', strtotime('-31 days', strtotime($d->sampaiTanggal)));
            @endphp
            <tr @if ($notifikasi < $date) style="background-color: #62B8C5" @endif>
                <td align="center" class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle">{{ $d->karyawanModel->namaKaryawan }}</td>
                <td class="align-middle text-center">
                    {{ $d->karyawanModel->departemen->kode }} /
                    {{ $d->karyawanModel->bagian->kode }} </td>
                <td class="align-middle">
                    {{ $d->noKontrak }}
                </td>
                <td class="align-middle text-center">
                    {{ $d->kontrakKe }}
                </td>
                <td class="align-middle text-center">
                    {{ varHelper::formatDate($d->berlakuTanggal) }}
                </td>
                <td class="align-middle text-center">
                    {{ varHelper::formatDate($d->sampaiTanggal) }}
                </td>
                <td class="align-middle text-center">
                    <a href="{{ URL::to('storage/pkwt/') }}/{{ $d->file }}" class="link" target="_blank">
                        File PKWT</a>

                </td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $d->id }}','{{ $d->noKontrak }}','{{ $d->kontrakKe }}','{{ $d->berlakuTanggal }}','{{ $d->sampaiTanggal }}','{{ $d->dibuatTanggal }}','{{ $d->idKaryawan }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $d->id }}','{{ $d->karyawanModel->namaKaryawan }}')"><i
                                class="fas fa-trash-alt"></i>
                            Delete</button>
                    </div>
                </td>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({
        responsive: true
    });
</script>
