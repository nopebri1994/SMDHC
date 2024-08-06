<table class="table table-striped table-bordered display nowrap" style="width:100%" id="tbl">
    <thead>
        <tr>
            <th rowspan="2" style="padding-bottom: 35px">#</th>
            <th rowspan="2" style="padding-bottom: 35px; text-align:center;">Nama Karyawan</th>
            <th rowspan="2" style="padding-bottom: 35px">Dept / Bagian</th>
            <th colspan="2" style="text-align:center;">Jadwal Kerja (Jam)</th>
            <th rowspan="2" style="padding-bottom: 35px">Jam Datang</th>
            <th rowspan="2" style="padding-bottom: 35px">Jam Pulang</th>
            <th rowspan="2" style="padding-bottom: 35px">T</th>
            <th rowspan="2" style="padding-bottom: 35px">Ket. Tidak Hadir</th>
            <th rowspan="2" style="padding-bottom: 35px">Hadir</th>
        </tr>
        <tr>
            <th>Datang</th>
            <th>Pulang</th>
        </tr>
    </thead>
    <tbody>
        @php
            $absenPulang = array_reverse($jamAbsen);
        @endphp
        @foreach ($dataKaryawan as $key => $dk)
            @php
                $dtg = '';
                $plg = '';
            @endphp
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $dk->namaKaryawan }}</td>
                <td class="text-center">{{ $dk->departemen->kode }}
                    @if ($dk->bagian->kode != null)
                        <span style="color:coral">&#8658;</span>
                    @endif
                    {{ $dk->bagian->kode }}
                </td>
                <td class="text-center" style="background-color:#6b86d4a3">
                    {{ $dk->jamKerja->jamMasukSJ }}
                </td>
                <td class="text-center" style="background-color:#f24141c4">
                    {{ $dk->jamKerja->jamPulangSJ }}
                </td>
                <td class="text-center">
                    @php
                        $obj = array_search($dk->fpId, array_column($jamAbsen, 'idFinger'));
                        if ($obj != '') {
                            $dtg = $jamAbsen[$obj]['jamAbsen'];
                            echo date('H:i', strtotime($jamAbsen[$obj]['jamAbsen']));
                        }
                    @endphp
                </td>
                <td class="text-center">
                    @php
                        $obj = array_search($dk->fpId, array_column($absenPulang, 'idFinger'));
                        if ($obj != '') {
                            $plg = $absenPulang[$obj]['jamAbsen'];
                            echo date('H:i', strtotime($absenPulang[$obj]['jamAbsen']));
                        }
                    @endphp
                </td>
                <td class="text-center">
                    @php
                        if ($dtg > $dk->jamKerja->jamMasukSJ) {
                            echo 'Ya';
                        }
                    @endphp
                </td>
                <td></td>
                <td class="text-center">
                    @php
                        if ($dtg <= $dk->jamKerja->jamMasukSJ and $plg >= $dk->jamKerja->jamPulangSJ) {
                            echo 'Full';
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({

    });
</script>
