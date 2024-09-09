<table class="tbl table table-sm table-striped table-bordered display nowrap" style="width: 100%">
    <thead>
        <tr>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">#</th>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">NIK</th>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">Nama Karyawan</th>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">Tanggal Masuk</th>
            <th rowspan="2" style="padding-bottom:20px; text-align:center;">Dept / Bagian</th>
            <th colspan="4" style=" text-align:center;">Tahun Ke</th>
        </tr>
        <tr>
            <th style=" text-align:center;">10</th>
            <th style=" text-align:center;">20</th>
            <th style=" text-align:center;">25</th>
            <th style=" text-align:center;">30</th>
        </tr>
    </thead>
    <tbody>
        @php
            $day = date('Y-m-d');
        @endphp
        @foreach ($karyawan as $key => $k)
            @php
                $pmk9 = date('Y-m-d', strtotime('+9 years', strtotime($k->tglMasuk)));
                $pmk10 = date('Y-m-d', strtotime('+10 years', strtotime($k->tglMasuk)));
                $pmk92 = date('Y-m-d', strtotime('+10 month', strtotime($pmk9)));
                $pmkdisplay1 = date('Y-m-d', strtotime('+10 years', strtotime($k->tglMasuk)));

                $pmk19 = date('Y-m-d', strtotime('+19 years', strtotime($k->tglMasuk)));
                $pmk192 = date('Y-m-d', strtotime('+10 month', strtotime($pmk19)));
                $pmk20 = date('Y-m-d', strtotime('+20 years', strtotime($k->tglMasuk)));
                $pmkdisplay2 = date('Y-m-d', strtotime('+20 years', strtotime($k->tglMasuk)));

                $pmk24 = date('Y-m-d', strtotime('+24 years', strtotime($k->tglMasuk)));
                $pmk25 = date('Y-m-d', strtotime('+25 years', strtotime($k->tglMasuk)));
                $pmk242 = date('Y-m-d', strtotime('+10 month', strtotime($pmk24)));
                $pmkdisplay3 = date('Y-m-d', strtotime('+25 years', strtotime($k->tglMasuk)));

                $pmk29 = date('Y-m-d', strtotime('+29 years', strtotime($k->tglMasuk)));
                $pmk30 = date('Y-m-d', strtotime('+30 years', strtotime($k->tglMasuk)));
                $pmk292 = date('Y-m-d', strtotime('+10 month', strtotime($pmk29)));
                $pmkdisplay4 = date('Y-m-d', strtotime('+30 years', strtotime($k->tglMasuk)));
            @endphp
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td class="text-center">{{ $k->nikKerja }}</td>
                <td>{{ $k->namaKaryawan }}</td>
                <td class="text-center">
                    {{ varHelper::formatDate($k->tglMasuk) }}
                </td>
                <td class="text-center">{{ $k->departemen->kode }}
                    @if ($k->bagian->kode != null)
                        <span style="color:coral">&#8658;</span>
                    @endif
                    {{ $k->bagian->kode }}
                </td>
                <td class="text-center">
                    @if ($day > $pmk92 and $day <= $pmk10)
                        <span class="badge badge-danger">
                            {{ varHelper::formatDate($pmkdisplay1) }}
                        </span>
                    @elseif($day > $pmk92)
                        <span class="badge badge-secondary">
                            {{ varHelper::formatDate($pmkdisplay1) }}
                        </span>
                    @else
                        {{ varHelper::formatDate($pmkdisplay1) }}
                    @endif

                </td>
                <td class="text-center">
                    @if ($day > $pmk192 and $day <= $pmk20)
                        <span class="badge badge-danger">
                            {{ varHelper::formatDate($pmkdisplay2) }}
                        </span>
                    @elseif($day > $pmk192)
                        <span class="badge badge-secondary">
                            {{ varHelper::formatDate($pmkdisplay2) }}
                        </span>
                    @else
                        {{ varHelper::formatDate($pmkdisplay2) }}
                    @endif
                </td>
                <td class="text-center">
                    @if ($day > $pmk242 and $day <= $pmk25)
                        <span class="badge badge-danger">
                            {{ varHelper::formatDate($pmkdisplay3) }}
                        </span>
                    @elseif($day > $pmk242)
                        <span class="badge badge-secondary">
                            {{ varHelper::formatDate($pmkdisplay3) }}
                        </span>
                    @else
                        {{ varHelper::formatDate($pmkdisplay3) }}
                    @endif
                </td>
                <td class="text-center">
                    @if ($day > $pmk292 and $day <= $pmk30)
                        <span class="badge badge-danger">
                            {{ varHelper::formatDate($pmkdisplay4) }}
                        </span>
                    @elseif($day > $pmk292)
                        <span class="badge badge-secondary">
                            {{ varHelper::formatDate($pmkdisplay4) }}
                        </span>
                    @else
                        {{ varHelper::formatDate($pmkdisplay4) }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
Catatan :
<ul>
    <li>Tahun Ke - 10 : Mendapatkan Lemari L33</li>
    <li>Tahun Ke - 20 : Mendapatkan Lemari L33</li>
    <li>Tahun Ke - 25 : Mendapatkan Emas</li>
    <li>Tahun Ke - 30 : Mendapatkan Lemari L33</li>
</ul>
<script>
    $('.tbl').DataTable({
        responsive: true
    });
</script>
