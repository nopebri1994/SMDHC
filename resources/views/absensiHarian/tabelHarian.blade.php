     <table class="table table-sm table-striped table-bordered display compact nowrap" style="width:100%;" id="tbl">
         <thead>
             <tr>
                 <th>#</th>
                 <th style="text-align:center;">Nama Karyawan</th>
                 <th style="text-align:center;">Dept / Bagian</th>
                 <th data-dt-order="disable" style="text-align:center;">Jadwal Masuk</th>
                 <th data-dt-order="disable" style="text-align:center;">Jadwal Pulang</th>
                 <th style="text-align:center;">Jam Datang</th>
                 <th style="text-align:center;">Jam Pulang</th>
                 <th style="text-align:center">T</th>
                 <th style="text-align:center;">Ket. Ijin</th>
                 <th style="text-align:center">Full</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($absensi as $key => $ab)
                 <tr>
                     <td class="text-center">{{ $key + 1 }}</td>
                     <td>{{ $ab->karyawanModel->namaKaryawan }}</td>
                     <td class="text-center" data-sort="{{ $ab->karyawanModel->departemen->kode }}">
                         {{ $ab->karyawanModel->departemen->kode }}
                         @if ($ab->karyawanModel->bagian->kode != null)
                             <span style="color:coral">&#8658;</span>
                         @endif
                         {{ $ab->karyawanModel->bagian->kode }}
                     </td>
                     <td class="text-center" style="background-color:#6b86d4a3">
                         @if (date('D', strtotime($tgl)) == 'Sat')
                             {{ $ab->karyawanModel->jamKerja->jamMasukS }}
                         @else
                             {{ $ab->karyawanModel->jamKerja->jamMasukSJ }}
                         @endif
                     </td>
                     <td class="text-center" style="background-color:#f24141c4">
                         @if (date('D', strtotime($tgl)) == 'Sat')
                             {{ $ab->karyawanModel->jamKerja->jamPulangS }}
                         @else
                             {{ $ab->karyawanModel->jamKerja->jamPulangSJ }}
                         @endif
                     </td>
                     <td class="text-center" @if ($ab->terlambat == 'Ya') style="background-color:yellow;" @endif>
                         {{ $ab->jamDatang }}
                     </td>
                     <td class="text-center">
                         {{ $ab->jamPulang }}
                     </td>
                     <td class="text-center" data-sort="{{ $ab->terlambat }}"
                         @if ($ab->terlambat == 'Ya') style="background-color:yellow;" @endif>
                         @can('hc')
                             <select id="terlambat{{ $ab->id }}" @if ($ab->terlambat != 'Ya') disabled @endif
                                 onchange="updateTerlambat({{ $ab->id }})"">
                                 <option value="Ya" @if ($ab->terlambat == 'Ya') selected @endif>
                                     Ya</option>
                                 <option value="Tidak" @if ($ab->terlambat != 'Ya') selected @endif>Tidak
                                 </option>
                             </select>
                         @endcan
                         @can('adminBagian')
                             {{ $ab->terlambat }}
                         @endcan
                     </td>
                     <td class="text-center">
                         @php
                             $ket_ijin = '';
                             $obj = array_search($ab->idKaryawan, array_column($ket, 'idKaryawan'));
                             if ($obj != '') {
                                 $ket_ijin = $ket[$obj]->kode;
                             }
                             //echo $ket_ijin;
                             if (!empty($off)) {
                                 if ($ab->karyawanModel->groupOff == $off->group) {
                                     $ket_ijin = 'SOF';
                                 }
                             }

                             echo $ket_ijin;
                         @endphp
                     </td>
                     <td class="text-center" data-sort="{{ $ab->full }}"
                         @if ($ab->full == 'Tidak') style="background-color:yellow;" @endif>
                         @can('hc')
                             <select id="full{{ $ab->id }}" @if ($ab->full == 'Ya') disabled @endif
                                 onchange="updateFull({{ $ab->id }})">
                                 <option value="Ya" @if ($ab->full == 'Ya') selected @endif>
                                     Ya</option>
                                 <option value="Tidak" @if ($ab->full != 'Ya') selected @endif>Tidak
                                 </option>
                             </select>
                         @endcan
                         @can('adminBagian')
                             {{ $ab->full }}
                         @endcan
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
     <script>
         $('#tbl').DataTable({
             responsive: true,
         });
     </script>
