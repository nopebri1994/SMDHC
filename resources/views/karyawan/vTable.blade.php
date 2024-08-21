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
             <th class="align-middle"></th>
         </tr>
     </thead>
     <tbody>
         @foreach ($karyawan as $key => $k)
             <tr>
                 <td class="text-center">{{ $key + 1 }}</td>
                 <td class="text-center">{{ $k->nikKerja }}</td>
                 <td>{{ $k->namaKaryawan }}</td>
                 <td class="text-center">{{ $k->jabatan->namaJabatan }}</td>
                 <td class="text-center">{{ $k->departemen->kode }}
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
                 <td class="text-center">{{ varHelper::formatDate($k->tglMasuk) }}</td>
                 <td class="align-middle text-center">
                     <div class="btn-group" role="group">
                         <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle btn-sm"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Action
                         </button>
                         <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                             <a class="dropdown-item" href="{{ URL::to("dk/karyawan/detail-data/$k->uuid") }}">Detail
                                 Data</a>
                             @can('hc')
                                 <a class="dropdown-item" href="{{ URL::to("dk/karyawan/edit-data/$k->uuid") }}">Edit</a>
                             @endcan
                             {{-- <a class="dropdown-item" href="#">Delete</a> --}}
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
