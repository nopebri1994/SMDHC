<style type="text/css">
table>thead>tr>th{
    text-align: center;
    height: 3rem;
};

</style>
<table class="table table-bordered table-sm table-striped shadow">
    <thead>
          <tr> 
              <th class="align-middle">#</th>
              <th class="align-middle">Kode</th>
              <th class="align-middle">Keterangan</th>
              <th class="align-middle">status</th>
              <th class="align-middle"></th>
          </tr>
      </thead>
      <tbody>
      
    
               @if(empty($dataTable))
                <tr>
                    <td colspan="4" align="center">
                        Data not available
                    </td>
                 <tr>
                @endif
          @foreach($dataTable as $key => $dt)
          <tr>
              <td align="center" class="align-middle">{{$dataTable->firstItem() + $key}}</td>
              <td class="align-middle text-center">{{$dt->kode}}</td>
              <td class="align-middle">{{$dt->keterangan}}</td>
              <td class="align-middle text-center">
                @if ($dt->status==1)
                    <span class="far fa-check-circle" style="color:blue"></span> Aktif 
                @else
                <span class="fas fa-times-circle c" style="color:brown"></span> Tidak Aktif
                @endif
              </td>
              <td align="center" width="25%">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary btn-sm" id="btnEdit" onclick="editData('{{$dt->kode}}','{{$dt->keterangan}}','{{$dt->status}}')"><i class="far fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btnDelete" onclick="deleteData({{$dt->id}},'{{$dt->kode}}')"><i class="fas fa-trash-alt"></i> Delete</button>
                  </div>
              </td>
          </tr>
          @endforeach
        
      </tbody>
  </table>
  {{ $dataTable->links() }}