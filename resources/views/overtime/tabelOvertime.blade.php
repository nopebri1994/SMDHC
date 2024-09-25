 <table class="tbl table table-bordered table-stripped table-sm display nowrap" style="width:100%">
     <thead>
         <tr>
             <th class="text-center">
                 #
             </th>
             <th class="text-center">
                 Tanggal Lembur
             </th>
             <th class="text-center">
                 Bagian
             </th>
             <th class="text-center">
                 Status Form Lembur
             </th>
             <th class="text-center" style="width:20%">
                 Aksi
             </th>
         </tr>
     </thead>
     <tbody>
         @foreach ($overtime as $key => $o)
             <tr>
                 <td class="text-center align-middle" style="width:5%">{{ $key + 1 }}</td>
                 <td class="text-center align-middle" style="width:12%">
                     {{ varHelper::formatDate($o->tanggalOT) }}</td>
                 <td class="text-center align-middle" style="width:12%">{{ $o->bagian->namaBagian }}</td>
                 <td class="align-middle">
                     @if (!$o->tanggalAcc and !$o->tanggalApp and !$o->tanggalCancel)
                         <h6>
                             <span class="badge badge-primary"> Menunggu Konfirmasi
                                 Bagian/Departemen</span>
                         </h6>
                     @elseif ($o->tanggalAcc and !$o->tanggalApp and !$o->tanggalCancel)
                         <h6>
                             <span class="badge badge-info">Form Sudah dikonfirmasi, Menunggu divalidasi oleh staf
                                 HC</span>
                         </h6>
                     @elseif ($o->tanggalApp and !$o->tanggalCancel)
                         <h6>
                             <span class="badge badge-success">Form Sudah diterima Oleh Staf HC</span>
                         </h6>
                     @elseif ($o->tanggalCancel)
                         <h6>
                             <span class="badge badge-danger">Form ditolak, silahkan menghubungi Staf HC</span>
                         </h6>
                     @endif
                 </td>
                 <td align="center" class="align-middle">
                     @can('hc')
                         <button class="btn btn-success btn-xs" onclick="confirm({{ $o->id }})"
                             @if (!$o->tanggalAcc or $o->tanggalApp or $o->tanggalCancel) disabled @endif>Confirm
                             Form</button>
                         <button class="btn btn-danger btn-xs" onclick="reject({{ $o->id }})"
                             @if (!$o->tanggalAcc or $o->tanggalApp or $o->tanggalCancel) disabled @endif>Reject
                             Form</button>
                     @endcan
                     @can('itAdmin')
                         <button class="btn btn-success btn-xs" onclick="accept({{ $o->id }})"
                             @if ($o->tanggalAcc) disabled @endif>Accept
                             Form</button>
                     @endcan
                     <a href="overtime/detail/{{ Crypt::encryptString($o->id) }}" class="btn btn-primary btn-xs"
                         target="_blank">Detail
                         Form</a>
                     {{-- <button class="btn btn-primary btn-xs">Accept Lembur</button>
                                                <button class="btn btn-danger btn-xs">Cancel Lembur</button> --}}
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
