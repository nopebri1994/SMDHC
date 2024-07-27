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
<table class="table table-bordered table-sm table-striped shadow display nowrap" style="width: 100%" id="tbl">
    <thead>
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Nama Mesin</th>
            <th class="align-middle">Ip Address</th>
            <th class="align-middle">Key</th>
            <th class="align-middle">Keterangan</th>
            <th class="align-middle"></th>

        </tr>
    </thead>
    <tbody>
        @foreach ($mesin as $key => $m)
            <tr>
                <td align="center" class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle text-center">{{ $m->namaMesin }}</td>
                <td class="align-middle">{{ $m->ipAddress }}</td>
                <td class="align-middle">{{ $m->key }}</td>
                <td class="align-middle">{{ $m->keterangan }}</td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $m->namaMesin }}','{{ $m->ipAddress }}','{{ $m->key }}','{{ $m->keterangan }}','{{ $m->id }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $m->id }}','{{ $m->namaMesin }}')"><i
                                class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({
        responsive: true
    });
</script>
