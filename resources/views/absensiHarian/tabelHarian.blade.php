       <table class="table table-sm table-bordered display compact nowrap" style="width:100%;" id="tbl">
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
                   @if (auth()->user()->karyawan->idBagian == $ab->karyawan->idBagian and auth()->user()->role == 5 or
                           auth()->user()->role <= 3)
                       <tr>
                           <td class="text-center">{{ $key + 1 }}</td>
                           <td>{{ $ab->karyawan->namaKaryawan }}</td>
                           <td class="text-center">{{ $ab->karyawan->departemen->kode }}
                               @if ($ab->karyawan->bagian->kode != null)
                                   <span style="color:coral">&#8658;</span>
                               @endif
                               {{ $ab->karyawan->bagian->kode }}
                           </td>
                           <td class="text-center" style="background-color:#6b86d4a3">
                               @if (date('D', strtotime($tgl)) == 'Sat')
                                   {{ $ab->karyawan->jamKerja->jamMasukS }}
                               @else
                                   {{ $ab->karyawan->jamKerja->jamMasukSJ }}
                               @endif
                           </td>
                           <td class="text-center" style="background-color:#f24141c4">
                               @if (date('D', strtotime($tgl)) == 'Sat')
                                   {{ $ab->karyawan->jamKerja->jamPulangS }}
                               @else
                                   {{ $ab->karyawan->jamKerja->jamPulangSJ }}
                               @endif
                           </td>
                           <td class="text-center"
                               @if ($ab->terlambat == 'Ya') style="background-color:yellow;" @endif>
                               {{ $ab->jamDatang }}
                           </td>
                           <td class="text-center">
                               {{ $ab->jamPulang }}
                           </td>
                           <td class="text-center" data-sort="{{ $ab->terlambat }}"
                               @if ($ab->terlambat == 'Ya') style="background-color:yellow;" @endif>
                               @can('hc')
                                   <select id="terlambat{{ $ab->id }}"
                                       @if ($ab->terlambat != 'Ya') disabled @endif
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
                                       $ket_ijin = $ket[$obj]['keterangan_ijin']['kode'];
                                   }
                                   echo $ket_ijin;
                               @endphp
                           </td>
                           <td class="text-center" data-sort="{{ $ab->Full }}"
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
                   @endif
               @endforeach
           </tbody>
       </table>
       <script>
           $('#tbl').DataTable({
               responsive: true,
           });
       </script>
