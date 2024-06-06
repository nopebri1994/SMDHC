<table class="table table-bordered table-sm">
    <thead>
          <tr>
              <th>#</th>
              <th>Kode</th>
              <th>Keterangan</th>
              <th>status</th>
          </tr>
      </thead>
      <tbody>
          @foreach($dataTable as $key => $dt)
          <tr>
              <td>{{$dataTable->firstItem() + $key}}</td>
              <td>{{$dt->kode}}</td>
              <td>{{$dt->keterangan}}</td>
              <td>{{$dt->status}}</td>
          </tr>
          @endforeach
      </tbody>
  </table>
  {{ $dataTable->links() }}
