<html>

<head>
    <style>
        /** Define the margins of your page **/
        @page {
            /* margin: 100px 25px; */
            margin-top: 6cm;
            margin-botom: 1.3cm
        }

        header {
            position: fixed;
            top: -4.8cm;
            left: 0px;
            right: 0px;
        }

        footer {
            position: fixed;
            bottom: -1cm;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        .head {
            text-align: center;
            font-size: 20px;
            padding-bottom: 28px
        }

        .center {
            text-align: center;
        }

        main>table {
            border: 1px solid black;
            border-collapse: collapse;
        }

        main>table>thead>tr>th {
            border: 2px solid black;
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <header style="height:300px">
        <div class="head">
            <u>Absensi Harian Karyawan</u>
        </div>
        <table>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $dataHeader->nikKerja }}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{ $dataHeader->namaKaryawan }}</td>
            </tr>
            <tr>
                <td>Dept. / Bagian</td>
                <td>:</td>
                <td>{{ $dataHeader->departemen->kode }} @if ($dataHeader->bagian->kode != null)
                        /
                    @endif
                    {{ $dataHeader->bagian->kode }}</td>
            </tr>
            <tr>
                <td>Dari Tanggal</td>
                <td>:</td>
                <td>{{ date('d F Y', strtotime($tglAwal)) }}</td>
            </tr>
            <tr>
                <td>Sampai Tanggal</td>
                <td>:</td>
                <td>{{ date('d F Y', strtotime($tglAkhir)) }}</td>
            </tr>
        </table>
    </header>

    <footer>
        <hr>
        <table style="width:100%">
            <tr>
                <td width="30%">
                    <i>Departemen Human Capital</i>
                </td>
                <td align="right">
                    <i>
                        Generated
                        {{ date('d-m-Y H:i:s') }}
                    </i>

                </td>
            </tr>
        </table>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <table border="1" style="width: 100%">
            <thead>
                <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Hari</th>
                    <th colspan="2">Jadwal Kerja</th>
                    <th colspan="2">Jam</th>
                    <th rowspan="2">Ket. Ijin</th>
                    <th rowspan="2">T</th>
                </tr>
                <tr>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Datang</th>
                    <th>Pulang</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $awal = $tglAwal;
                    $i = 1;
                @endphp
                @while (strtotime($awal) <= strtotime($tglAkhir))
                    @php
                        $obj = array_search($awal, array_column($dataisi, 'tglAbsen'));
                    @endphp
                    <tr @if (date('l', strtotime($awal)) == 'Sunday') style="background-color: #ff9999" @endif>
                        <td class="center">{{ $i }}</td>
                        <td class="center">{{ date('d-m-Y', strtotime($awal)) }}</td>
                        <td class="center">{{ date('l', strtotime($awal)) }}</td>
                        <td class="center">
                            @if(!empty($obj))
                                @if (date('l', strtotime($awal)) == 'Saturday')
                                    {{ date('H:i', strtotime($dataisi[$obj]['karyawan']['jam_kerja']['jamMasukS'])) }}
                                @elseif(date('l', strtotime($awal)) != 'Sunday')
                                    {{ date('H:i', strtotime($dataisi[$obj]['karyawan']['jam_kerja']['jamMasukSJ'])) }}
                                @endif
                            @endif
                        </td>
                        <td class="center">
                            @if(!empty($obj))
                                @if (date('l', strtotime($awal)) == 'Saturday')
                                    {{ date('H:i', strtotime($dataisi[$obj]['karyawan']['jam_kerja']['jamPulangS'])) }}
                                @elseif(date('l', strtotime($awal)) != 'Sunday')
                                    {{ date('H:i', strtotime($dataisi[$obj]['karyawan']['jam_kerja']['jamPulangSJ'])) }}
                                @endif
                            @endif
                        </td>
                        <td class="center">
                            @if(!empty($obj))
                                @if ($dataisi[$obj]['jamDatang'] != null)
                                    {{ date('H:i', strtotime($dataisi[$obj]['jamDatang'])) }}
                                @endif
                            @endif
                        </td>
                        <td class="center">
                            @if(!empty($obj))
                                @if ($dataisi[$obj]['jamPulang'] != null)
                                    {{ date('H:i', strtotime($dataisi[$obj]['jamPulang'])) }}
                            @endif
                            @endif
                        </td>
                        <td class="center"></td>
                        <td class="center" @if(!empty($obj)) @if ($dataisi[$obj]['terlambat'] != 'Tidak') style="background-color:yellow" @endif @endif>
                            @if(!empty($obj))
                                @if ($dataisi[$obj]['terlambat'] != 'Tidak')
                                    {{ $dataisi[$obj]['terlambat'] }}
                                @endif
                            @endif
                        </td>
                    </tr>
                    @php
                        $i++;
                        $awal = date('Y-m-d', strtotime('+1 days', strtotime($awal)));
                    @endphp
                @endwhile
            </tbody>
        </table>
    </main>
</body>
</html>
