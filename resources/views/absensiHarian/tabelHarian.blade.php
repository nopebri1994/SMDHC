<table class="table table-bordered display compact nowrap" style="width:100%;" id="tbl">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">Nama Karyawan</th>
            <th style="">Dept / Bagian</th>
            <th data-dt-order="disable">Jadwal Masuk</th>
            <th data-dt-order="disable">Jadwal Pulang</th>
            <th style="">Jam Datang</th>
            <th style="">Jam Pulang</th>
            <th style="">T</th>
            <th style="">Ket. Tidak Hadir</th>
            <th style="">Hadir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absensi as $key => $ab)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ $ab->karyawan->namaKaryawan }}</td>
                <td class="text-center">{{ $ab->karyawan->departemen->kode }}
                    @if ($ab->karyawan->bagian->kode != null)
                        <span style="color:coral">&#8658;</span>
                    @endif
                    {{ $ab->karyawan->bagian->kode }}
                </td>
                <td class="text-center" style="background-color:#6b86d4a3">
                    @if (date('D', strtotime($tgl)) == 'Sat')
                        {{ $ab->karyawan->jamKerja->jamMasukS }}
                    @else
                        {{ $ab->karyawan->jamKerja->jamMasukSJ }}
                    @endif
                </td>
                <td class="text-center" style="background-color:#f24141c4">
                    @if (date('D', strtotime($tgl)) == 'Sat')
                        {{ $ab->karyawan->jamKerja->jamPulangS }}
                    @else
                        {{ $ab->karyawan->jamKerja->jamPulangSJ }}
                    @endif
                </td>
                <td class="text-center">
                    {{ $ab->jamDatang }}
                </td>
                <td class="text-center">
                    {{ $ab->jamPulang }}
                </td>
                <td class="text-center" @if ($ab->terlambat == 'Ya') style="background-color:yellow;" @endif>
                    {{ $ab->terlambat }}
                </td>
                <td class="text-center">
                    @php
                        $ket_ijin = '';
                        $obj = array_search($ab->idKaryawan, array_column($ket, 'idKaryawan'));
                        if ($obj != '') {
                            $ket_ijin = $ket[$obj]['keterangan_ijin']['kode'];
                        }
                        echo $ket_ijin;
                    @endphp
                </td>
                <td class="text-center">
                    {{ $ab->full }}
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
