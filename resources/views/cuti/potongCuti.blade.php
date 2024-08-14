<table class="table display nowrap" id="tblPotong" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th style="width:25%">Nama</th>
            <th style="width:15%">Dept</th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Tahun</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($potongCuti as $key => $tp)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $tp->karyawan->nikKerja }}</td>
                <td>{{ $tp->karyawan->namaKaryawan }}</td>
                <td class="text-center">{{ $tp->karyawan->departemen->kode }}
                    @if ($tp->karyawan->bagian->kode != null)
                        <span style="color:coral">&#8658;</span>
                    @endif
                    {{ $tp->karyawan->bagian->kode }}
                </td>
                <td>{{ $tp->jumlahPotong }}</td>
                <td>{{ $tp->keterangan }}</td>
                <td>{{ $tp->tahunCuti }}</td>
                <td>{{ $tp->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tblPotong').DataTable({
        responsive: true
    });
</script>
