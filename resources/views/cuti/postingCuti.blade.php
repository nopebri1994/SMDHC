<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Karywan</th>
            <th>Tanggal Masuk</th>
            <th>Hak Cuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vCuti as $key => $c)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $c->karyawan->namaKaryawan }}</td>
                <td>{{ varHelper::formatDate($c->karyawan->tglMasuk) }}</td>
                <td>{{ $c->jumlahCuti }}</td>
            </tr>
            <tr>
                <td colspan="4">Keterangan :
                    <i>{{ $c->keterangan }}</i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
