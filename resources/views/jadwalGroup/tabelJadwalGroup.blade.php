<style type="text/css">
    .dt-search {
        padding-bottom: 10px;
    }

    .dt-paging {
        padding-top: 10px;
    }
</style>
<table class="table table-sm table-striped table-bordered display nowrap" style="width: 100%" id="tbl">
    <thead>
        <tr>
            <th class="align-middle  text-center" style="width: 5%">#</th>
            <th class="align-middle text-center" style="width:15%%">Group Kerja</th>
            <th class="align-middle  text-center">Tanggal</th>
            <th class="align-middle  text-center">Jam Kerja</th>

            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $d)
            <tr>
                <td align="center" class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle text-center">{{ $d->groupKerja->groupKerja }}</td>
                <td class="align-middle text-center">{{ varHelper::formatDate($d->tanggal) }}</td>
                <td class="align-middle text-center">{{ $d->jamKerja->kodeJamKerja }}</td>
                <td align="center" width="5%">
                    <button type="button" class="btn btn-danger btn-xs" id="btnDelete"
                        onclick="deleteData('{{ $d->id }}','{{ $d->groupKerja->groupKerja }}')"><i
                            class="fas fa-trash-alt"></i> Delete</button>
                </td>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({
        responsive: true
    });
</script>
