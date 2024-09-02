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
            <th class="align-middle text-center">NIK</th>
            <th class="align-middle text-center">Nama Karyawan</th>
            <th class="align-middle  text-center">Dept / Bagian</th>
            <th class="align-middle  text-center">Tanggal Keluar</th>
            <th class="align-middle  text-center">Keterangan</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $d)
            <tr>
                <td align="center" class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle">{{ $d->karyawan->nikKerja }}</td>
                <td class="align-middle">{{ $d->karyawan->namaKaryawan }}</td>
                <td class="align-middle text-center">{{ $d->karyawan->bagian->kode }} /
                    {{ $d->karyawan->departemen->kode }} </td>
                <td class="align-middle text-center">
                    {{ varHelper::formatDate($d->tanggalKeluar) }}
                </td>
                <td class="align-middle text-center">
                    {{ $d->keterangan }}
                </td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $d->id }}','{{ $d->idKaryawan }}','{{ $d->keterangan }}','{{ $d->tanggalKeluar }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $d->id }}','{{ $d->karyawan->namaKaryawan }}','{{ $d->idKaryawan }}')"><i
                                class="fas fa-trash-alt"></i> Delete</button>
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
