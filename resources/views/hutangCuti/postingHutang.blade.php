<table class="table table-striped" width="100%" id="tbl">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Karywan</th>
            <th>Tanggal Masuk</th>
            <th>Maksimal Hutang</th>
            <th>Expired</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vCuti as $key => $c)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $c->karyawan->namaKaryawan }}</td>
                <td>{{ varHelper::formatDate($c->karyawan->tglMasuk) }}</td>
                <td class="text-center">{{ $c->jumlahHutangCuti }}</td>
                <td>{{ varHelper::formatDate($c->expired) }}</td>
                <td width="35%"> <i>{{ $c->keterangan }}</i></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable();
</script>
