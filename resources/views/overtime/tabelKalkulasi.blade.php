<table class="tbl table table-bordered table-stripped table-sm display nowrap" style="width:100%">
    <thead>
        <tr>
            <th class="text-center" style="width: 5%">
                #
            </th>
            <th class="text-center" style="width:7%">
                NIK
            </th>
            <th class="text-center">
                Nama Karyawan
            </th>
            <th class="text-center" style="width:7%">
                Bagian
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
            <th class="text-center" style="width:8%">
                Detail
            </th>
        </tr>
    </thead>
    <tbody>
        @php
            $collectionBagian = collect($bagian);
        @endphp
        @foreach ($overtime as $key => $ot)
            @php
                $findBagian = $collectionBagian->firstWhere('id', $ot->idBagian);
            @endphp
            <tr>
                <td class="text-center align-middle">{{ $key + 1 }}</td>
                <td class="text-center align-middle">{{ $ot->nikKerja }}</td>
                <td class="align-middle">{{ $ot->namaKaryawan }}</td>
                <td class="text-center align-middle">
                    @if ($findBagian)
                        @if ($findBagian['departemen'])
                            {{ $findBagian['departemen']['kode'] }} /
                            {{ $findBagian['kode'] }}
                        @else
                            {{ $findBagian['departemen']['kode'] }}
                        @endif
                    @endif
                </td>
                <td class="text-center align-middle">{{ $ot->jam1 }}</td>
                <td class="text-center align-middle">{{ $ot->jam2 }}</td>
                <td class="text-center align-middle">{{ $ot->jam1 + $ot->jam2 }} Jam</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-primary"
                        onclick="getLemburDetail('{{ $ot->idKaryawan }}')" data-target="#detailModal"
                        data-toggle="modal"> <span class="fa fa-table"></span>&nbsp;Detail</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('.tbl').DataTable({
        responsive: true
    });
</script>
