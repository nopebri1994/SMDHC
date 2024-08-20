<table class="table table-striped display tbl nowrap" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Maks. Hutang</th>
            <th>Tahun Potongan</th>
            <th>Exp</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vCuti as $key => $c)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $c->karyawan->nikKerja }}</td>
                <td width="20%">{{ $c->karyawan->namaKaryawan }}</td>
                <td>{{ varHelper::formatDate($c->karyawan->tglMasuk) }}</td>
                <td class="text-center" width="10%">{{ $c->jumlahHutangCuti }}</td>
                <td>{{ $c->year }}</td>
                <td>{{ varHelper::formatDate($c->expired) }}</td>
                <td width="25%"> <i>{{ $c->keterangan }}</i></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('.tbl').DataTable({
        responsive:true
    });
</script>
