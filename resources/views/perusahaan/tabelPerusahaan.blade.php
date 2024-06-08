<style type="text/css">
    table>thead>tr>th {
        text-align: center;
        height: 3rem;
    }

    ;
</style>
<table class="table table-bordered table-sm table-striped shadow">
    <thead>
        <tr>
            <th class="align-middle">#</th>
            <th class="align-middle">Nama Perusahaan</th>
            <th class="align-middle"></th>
        </tr>
    </thead>
    <tbody>
        @if ($dataTable->count() == 0)
            <tr>
                <td colspan="3" align="center">
                    Data not available
                </td>
            <tr>
        @endif
        @foreach ($dataTable as $key => $dt)
            <tr>
                <td align="center" class="align-middle">{{ $dataTable->firstItem() + $key }}</td>
                <td class="align-middle">{{ $dt->namaPerusahaan }}</td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $dt->namaPerusahaan }}','{{ $dt->id }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $dt->id }}','{{ $dt->namaPerusahaan }}')"><i
                                class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
{{ $dataTable->links() }}
