<style type="text/css">
    table>thead>tr>th {
        text-align: center;
        height: 3rem;
    }

    ;
</style>
<div class="table-responsive">
    <table class="nowrap table table-bordered table-sm table-striped shadow">
        <thead>
            <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Kode</th>
                <th class="align-middle">Nama Bagian</th>
                <th class="align-middle">Departemen</th>
                <th class="align-middle">Perusahaan</th>
                <th class="align-middle"></th>
            </tr>
        </thead>
        <tbody>
            @if ($dataTable->count() == 0)
                <tr>
                    <td colspan="6" align="center">
                        Data not available
                    </td>
                <tr>
            @endif
            @foreach ($dataTable as $key => $dt)
                <tr>
                    <td align="center" class="align-middle" width="4%">{{ $dataTable->firstItem() + $key }}</td>
                    <td class="align-middle" align="center" width="5%">{{ $dt->kode }}</td>
                    <td class="align-middle" width="25%">{{ $dt->namaBagian }}</td>
                    <td class="align-middle" width="20%">{{ $dt->departemen->namaDepartemen }}</td>
                    <td class="align-middle" style="font-size:0.8em">
                        {{ $dt->departemen->perusahaan->namaPerusahaan }}</td>
                    <td align="center" class="align-middle" width="22%">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                                onclick="editData('{{ $dt->namaBagian }}',{{ $dt->id }},'{{ $dt->idDepartemen }}','{{ $dt->kode }}')"><i
                                    class="far fa-edit"></i> Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                                onclick="deleteData({{ $dt->id }},'{{ $dt->namaBagian }}')"><i
                                    class="fas fa-trash-alt"></i> Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $dataTable->links() }}
</div>
