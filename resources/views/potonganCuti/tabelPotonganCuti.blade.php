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
            <th class="align-middle">Tahun</th>
            <th class="align-middle">Nama</th>
            <th class="align-middle">Total Potongan</th>
            <th rowspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @if ($dataTable->count() == 0)
            <tr>
                <td colspan="5" align="center">
                    Data not available
                </td>
            <tr>
        @endif
        @foreach ($dataTable as $key => $dt)
            <tr>
                <td align="center" class="align-middle">{{ $dataTable->firstItem() + $key }}</td>
                <td class="align-middle text-center">{{ $dt->tahunPotongan }}</td>
                <td class="align-middle text-center">{{ $dt->namaPotongan }}</td>
                <td class="align-middle text-center">{{ $dt->totalPotongan }}</td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $dt->id }}','{{ $dt->tahunPotongan }}','{{ $dt->namaPotongan }}','{{ $dt->totalPotongan }}','{{ $dt->keterangan }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $dt->id }}','{{ $dt->namaPotongan }}')"><i
                                class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="5"><i>keterangan :</i>{{ $dt->keterangan }}</td>
            </tr>
        @endforeach

    </tbody>
</table>
{{ $dataTable->links() }}
