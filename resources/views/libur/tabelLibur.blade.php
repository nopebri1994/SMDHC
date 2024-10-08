<style type="text/css">
    table>thead>tr>th {
        text-align: center;
        height: 3rem;
    }

    .dt-search {
        padding-bottom: 10px;
    }

    .dt-paging {
        padding-top: 10px;
    }
</style>
<table class="table table-bordered table-sm table-striped shadow" id="tbl">
    <thead>
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Tanggal Libur</th>
            <th class="align-middle">Keterangan</th>
            <th class="align-middle"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($libur as $key => $l)
            <tr>
                <td align="center" class="align-middle">{{ $key + 1 }}</td>
                <td class="align-middle text-center">{{ varHelper::formatDate($l->tanggalLibur) }}</td>
                <td class="align-middle">{{ $l->keterangan }}</td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $l->tanggalLibur }}','{{ $l->keterangan }}','{{ $l->id }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $l->id }}','{{ $l->tanggalLibur }}')"><i
                                class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
<script>
    $('#tbl').DataTable();
</script>
