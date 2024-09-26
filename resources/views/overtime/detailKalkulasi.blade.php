<div class="col-6">
    <b>{{ $karyawan->namaKaryawan }}</b>&nbsp;({{ $karyawan->nikKerja }})
</div>
<hr>
<table class="tbl2 table table-bordered table-stripped table-sm display nowrap" style="width:100%">
    <thead>
        <tr>
            <th class="text-center" style="width: 5%">
                #
            </th>
            <th class="text-center">
                Tanggal OT
            </th>
            <th class="text-center" style="width:7%">
                Jam 1
            </th>
            <th class="text-center" style="width:7%">
                Jam 2
            </th>
            <th class="text-center" style="width:7%">
                Total
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $jam1 = 0;
            $jam2 = 0;
        @endphp
        @foreach ($overtime as $key => $ot)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>{{ varHelper::formatDate($ot->overtimeModel->tanggalOT) }}</td>
                <td class="text-center">{{ $ot->jam1 }} Jam</td>
                <td class="text-center">{{ $ot->jam2 }} Jam</td>
                <td class="text-center">{{ $ot->jam1 + $ot->jam2 }} Jam</td>
            </tr>
            @php
                $jam1 += $ot->jam1;
                $jam2 += $ot->jam2;
            @endphp
        @endforeach

    </tbody>
    <tfoot>
        <tr style="background-color:beige">
            <td colspan="2" class="text-center"><b>Total Overtime (Lembur)</b></td>
            <td class="text-center">{{ $jam1 }} Jam</td>
            <td class="text-center">{{ $jam2 }} Jam</td>
            <td class="text-center"><b>{{ $jam1 + $jam2 }} Jam</b></td>
        </tr>
    </tfoot>
</table>
<script>
    $('.tbl2').DataTable({
        responsive: true
    });
</script>
