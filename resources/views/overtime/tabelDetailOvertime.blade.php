 <table class="tbl table table-striped table-bordered table-sm display nowrap" style="width: 100%" id="dataProses">
     <thead>
         <tr>
             <th style="width:3%;text-align:center">
                 #
             </th>
             <th style="width:8%;text-align:center">
                 NIK
             </th>
             <th style="width:15%;text-align:center">
                 Nama Karyawan
             </th>
             <th style="width:8%;text-align:center">
                 Lembur
             </th>
             <th style="">
                 jenis Pekerjaan
             </th>
             <th style="text-align:center">
                 Jadwal Masuk
             </th>
             <th style="text-align:center">
                 Jadwal Pulang
             </th>
             <th style="text-align:center">
                 Mulai Lembur
             </th>
             <th style="text-align:center">
                 Jam Pulang
             </th>
             <th style="width: :5%">
             </th>
         </tr>
     </thead>
     <tbody>
         @php
             $abs = collect($absensi);
         @endphp
         @foreach ($data as $key => $d)
             @php
                 $detailAbsensi = $abs->firstWhere('idKaryawan', $d->idKaryawan);
             @endphp
             <tr>
                 <td style="text-align:center" class="align-middle">
                     {{ $key + 1 }}
                 </td>
                 <td style="text-align:center" class="align-middle">
                     {{ $d->karyawan->nikKerja }}
                 </td>
                 <td class="align-middle">
                     {{ $d->karyawan->namaKaryawan }}
                 </td>
                 <td style="text-align:center; @if ($d->status == 0) background-color:rgb(232,103,103); @endif"
                     class="align-middle">
                     {{ $d->jam1 + $d->jam2 }} Jam
                 </td>
                 <td class="align-middle">
                     {{ $d->jenisPekerjaan }}
                 </td>
                 <td style="text-align:center" class="align-middle">
                     @if ($detailAbsensi)
                         {{ $detailAbsensi['jadwalMasuk'] }}
                     @endif
                 </td>
                 <td style="text-align:center" class="align-middle">
                     @if ($detailAbsensi)
                         {{ $detailAbsensi['jadwalPulang'] }}
                     @endif
                 </td>
                 <td style="text-align:center" class="align-middle">
                     @if ($detailAbsensi)
                         {{ date('H:i', strtotime('+30 minutes', strtotime($detailAbsensi['jadwalPulang']))) }}
                     @endif

                 </td>
                 <td style="text-align:center" class="align-middle">
                     @if ($detailAbsensi)
                         {{ $detailAbsensi['jamPulang'] }}
                     @endif
                 </td>

                 <td align="center">
                     <button type="button" class="btn btn-primary btn-xs" onclick="updateStatus({{ $d->id }},2)"
                         @if ($d->status != 1) disabled @endif><i class="far fa-check-circle"></i>
                         Accept</button>
                     <button type="button" class="btn btn-danger btn-xs" onclick="updateStatus({{ $d->id }},0)"
                         @if ($d->status != 1) disabled @endif><i class="fas fa-times"></i>
                         Cancel</button>

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
