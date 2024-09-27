 <table class="table table-sm table-bordered table-striped display nowrap tbl" style="width: 100%">
     <thead>
         <tr class="text-center align-middle" style="height: 3rem">
             <th class="align-middle text-center">#</th>
             <th class="align-middle text-center">NIK</th>
             <th class="align-middle text-center">Nama Karyawan</th>
             <th class="align-middle text-center">Jabatan</th>
             <th class="align-middle text-center">Dept. / Bagian</th>
             <th class="align-middle text-center">Jenis Kelamin</th>
             <th class="align-middle text-center">Tanggal Masuk</th>
             <th class="align-middle text-center">Status</th>
             <th class="align-middle"></th>
         </tr>
     </thead>
     <tbody>
         @foreach ($karyawan as $key => $k)
             <tr>
                 <td class="text-center my-auto align-middle">{{ $key + 1 }}</td>
                 <td class="text-center align-middle">{{ $k->nikKerja }}</td>
                 <td class="align-middle">{{ $k->namaKaryawan }}</td>
                 <td class="text-center align-middle">{{ $k->jabatan->namaJabatan }}</td>
                 <td class="text-center align-middle">{{ $k->departemen->kode }}
                     @if ($k->bagian->kode != null)
                         <span style="color:coral">&#8658;</span>
                     @endif
                     {{ $k->bagian->kode }}
                 </td>
                 <td class="align-middle text-center">
                     @if ($k->jenisKelamin == '1')
                         <span class="badge badge-success" style="font-size:0.8rem">
                             {{ varHelper::varJK($k->jenisKelamin) }}
                         </span>
                     @else
                         <span class="badge badge-danger" style="font-size:0.8rem">
                             {{ varHelper::varJK($k->jenisKelamin) }}
                         </span>
                     @endif

                 </td>
                 <td class="text-center align-middle">{{ varHelper::formatDate($k->tglMasuk) }}</td>
                 <td class="text-center align-middle">{{ varHelper::varStatusKaryawan($k->statusKaryawan) }}</td>

                 <td class="align-middle text-center">
                     <div class="btn-group">
                         <button type="button" class="btn btn-default btn-sm">Action</button>
                         <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon"
                             data-toggle="dropdown">
                             <span class="sr-only">Toggle Dropdown</span>
                         </button>
                         <div class="dropdown-menu" role="menu">
                             <a class="dropdown-item" href="{{ URL::to("dk/karyawan/detail-data/$k->uuid") }}">Detail
                                 Data</a>
                             @can('hc')
                                 <a class="dropdown-item" href="{{ URL::to("dk/karyawan/edit-data/$k->uuid") }}">Edit</a>
                             @endcan
                         </div>
                     </div>
                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>
 <script>
     $('.tbl').DataTable({
         responsive: true,
     });
 </script>
