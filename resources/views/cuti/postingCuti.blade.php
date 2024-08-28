<table class="table table-striped display nowrap" width="100%" id="tbl">
    <thead>
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th style="width:25%">Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Hak Cuti</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vCuti as $key => $c)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $c->karyawan->nikKerja }}</td>
                <td>{{ $c->karyawan->namaKaryawan }}</td>
                <td>{{ varHelper::formatDate($c->karyawan->tglMasuk) }}</td>
                <td class="text-center">{{ $c->jumlahCuti }}</td>
                <td width="35%">
                    <i>{{ $c->keterangan }}</i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({
        responsive: true,
    });
</script>
