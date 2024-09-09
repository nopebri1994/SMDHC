<table class="tbl table table-sm table-striped table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">#</th>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">NIK</th>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">Nama Karyawan</th>
            <th colspan="10" style=" text-align:center;">Total Ijin</th>
        </tr>
        <tr>
            <th style=" text-align:center;">AL</th>
            <th style=" text-align:center;">AD</th>
            <th style=" text-align:center;">SL</th>
            <th style=" text-align:center;">CL</th>
            <th style=" text-align:center;">CL2</th>
            <th style=" text-align:center;">ISD</th>
            <th style=" text-align:center;">ISH</th>
            <th style=" text-align:center;">NPL</th>
            <th style=" text-align:center;">A</th>
            <th style=" text-align:center;">T</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($karyawan as $key => $k)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ $k->nikKerja }}</td>
                <td>{{ $k->namaKaryawan }}</td>
                <td class="text-center">{{ $k->al }}</td>
                <td class="text-center">{{ $k->ad }}</td>
                <td class="text-center">{{ $k->sl }}</td>
                <td class="text-center">{{ $k->cl }}</td>
                <td class="text-center">{{ $k->cl2 }}</td>
                <td class="text-center">{{ $k->isd }}</td>
                <td class="text-center">{{ $k->ish }}</td>
                <td class="text-center">{{ $k->npl }}</td>
                <td class="text-center">{{ $k->a }}</td>
                <td class="text-center">{{ $k->t }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
Catatan :
<ul>
    <li>Data Kalkulasi dimulai dari tanggal 01 September 2024.</li>
    <li>Sebelum tanggal 01 September 2024, cek disistem absensi yang lama.</li>
    <li>T = Terlamabat</li>
</ul>
</ul>
<script>
    $('.tbl').DataTable({
        responsive: true
    });
</script>
