<table class="table table-responsive display nowrap" id="tblTambah" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>NIK</th>
            <th style="width:25%">Nama</th>
            <th style="width:15%">Dept</th>
            <th>Total</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tambahCuti as $key => $tc)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $tc->karyawan->nikKerja }}</td>
                <td>{{ $tc->karyawan->namaKaryawan }}</td>
                <td class="text-center">{{ $tc->karyawan->departemen->kode }}
                    @if ($tc->karyawan->bagian->kode != null)
                        <span style="color:coral">&#8658;</span>
                    @endif
                    {{ $tc->karyawan->bagian->kode }}
                </td>
                <td>{{ $tc->jumlahTambah }}</td>
                <td>{{ $tc->tahunCuti }}</td>
                <td>{{ $tc->status }}</td>
                <td>
                    <details>
                        <summary>Keterangan</summary>
                        <p>
                            {{ $tc->keterangan }}
                        </p>
                    </details>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tblTambah').DataTable({
        responsive: true
    });
</script>
