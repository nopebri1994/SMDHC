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
            <th class="align-middle" rowspan="2">#</th>
            <th class="align-middle" rowspan="2">Kode</th>
            <th class="align-middle" colspan="2">Senin - Jumat</th>
            <th class="align-middle" colspan="2">Sabtu</th>
            <th rowspan="2"></th>
        </tr>
        <tr>
            <th class="align-middle">Jam Masuk</th>
            <th class="align-middle">Jam Pulang</th>
            <th class="align-middle">Jam Masuk</th>
            <th class="align-middle">Jam Pulang</th>
        </tr>
    </thead>
    <tbody>
        @if ($dataTable->count() == 0)
            <tr>
                <td colspan="7" align="center">
                    Data not available
                </td>
            <tr>
        @endif
        @foreach ($dataTable as $key => $dt)
            <tr>
                <td align="center" class="align-middle">{{ $dataTable->firstItem() + $key }}</td>
                <td class="align-middle text-center">{{ $dt->kodeJamKerja }}</td>
                <td class="align-middle">{{ $dt->jamMasukSJ }}</td>
                <td class="align-middle">{{ $dt->jamPulangSJ }}</td>
                <td class="align-middle">{{ $dt->jamMasukS }}</td>
                <td class="align-middle">{{ $dt->jamPulangS }}</td>
                <td align="center" width="25%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $dt->kodeJabatan }}','{{ $dt->namaJabatan }}','{{ $dt->id }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                            onclick="deleteData('{{ $dt->id }}','{{ $dt->kodeJabatan }}')"><i
                                class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
{{ $dataTable->links() }}
