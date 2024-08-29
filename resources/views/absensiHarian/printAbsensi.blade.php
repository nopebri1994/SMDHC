<html>

<head>
    <title>Data Absensi Harian - {{ $dataHeader->namaKaryawan }}</title>
    <style>
        /** Define the margins of your page **/
        @page {
            /* margin: 100px 25px; */
            margin-top: 8cm;
            margin-botom: 1.3cm;
        }

        header {
            position: fixed;
            top: -6cm;
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
            padding-bottom: 24px
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

        main>table>tbody>tr>td {
            border: 1px solid black;
        }

        main {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <header style="height:300px">
        <div style="margin-top: -1cm;margin-left:-1.5cm">
            <img src="{{ public_path('/') }}/assets/img/documenLion.png" alt="" width="105%">
        </div>
        <div class="head">
            <u>Absensi Harian Karyawan</u>
        </div>
        <table style="font-size:14px">
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
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ date('d', strtotime($tglAwal)) }}
                    {{ varHelper::bulanIndo(date('F', strtotime($tglAwal))) }}
                    {{ date('Y', strtotime($tglAwal)) }} -
                    {{ date('d', strtotime($tglAkhir)) }}
                    {{ varHelper::bulanIndo(date('F', strtotime($tglAkhir))) }}
                    {{ date('Y', strtotime($tglAkhir)) }}
                </td>
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
                    <th rowspan="2" style="width: 5%">#</th>
                    <th rowspan="2" style="width:10%">Tanggal</th>
                    <th rowspan="2" style="width: 11%">Hari</th>
                    <th colspan="2">Jadwal Kerja</th>
                    <th colspan="2">Jam</th>
                    <th rowspan="2" style="width: 5%">Ijin</th>
                    <th rowspan="2" style="width: 5%">T</th>
                    <th rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th style="width: 7%">Masuk</th>
                    <th style="width: 7%">Pulang</th>
                    <th style="width: 7%">Datang</th>
                    <th style="width: 7%">Pulang</th>
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
                        $keterangan = '';
                        $objLibur = array_search($awal, array_column($libur, 'tanggalLibur'));
                        if ($objLibur != '') {
                            $keterangan = $libur[$objLibur]['keterangan'];
                        } elseif (date('l', strtotime($awal)) == 'Sunday') {
                            $keterangan = '#';
                        }
                        $ketSof = '';
                        $off = array_search($awal, array_column($sof, 'tanggalOff'));
                        if ($off != '' and $sof[$off]['group'] == $dataHeader->groupOff) {
                            $ketSof = 'SOF';
                        }
                    @endphp
                    <tr @if (date('l', strtotime($awal)) == 'Sunday' or $keterangan != '') style="background-color: #ff9999" @endif>
                        <td class="center">{{ $i }}</td>
                        <td class="center">{{ date('d-m-Y', strtotime($awal)) }}</td>
                        <td class="center">{{ varHelper::hariIndo(date('l', strtotime($awal))) }}</td>
                        <td class="center" style="font-style:italic">
                            @if (!empty($obj))
                                {{ date('H:i', strtotime($dataisi[$obj]['jadwalMasuk'])) }}
                            @endif
                        </td>
                        <td class="center" style="font-style:italic">
                            @if (!empty($obj))
                                {{ date('H:i', strtotime($dataisi[$obj]['jadwalPulang'])) }}
                            @endif
                        </td>
                        <td class="center">
                            @if (!empty($obj))
                                @if ($dataisi[$obj]['jamDatang'] != null)
                                    {{ date('H:i', strtotime($dataisi[$obj]['jamDatang'])) }}
                                @endif
                            @endif

                        </td>
                        <td class="center">
                            @if (!empty($obj))
                                @if ($dataisi[$obj]['jamPulang'] != null)
                                    {{ date('H:i', strtotime($dataisi[$obj]['jamPulang'])) }}
                                @endif
                            @endif
                        </td>
                        <td class="center">
                            {{ $dataisi[$obj]['keteranganIjin'] }}
                        </td>
                        <td class="center"
                            @if (!empty($obj)) @if ($dataisi[$obj]['terlambat'] != 'Tidak') style="background-color:yellow" @endif
                            @endif>
                            @if (!empty($obj))
                                @if ($dataisi[$obj]['terlambat'] != 'Tidak')
                                    {{ $dataisi[$obj]['terlambat'] }}
                                @endif
                            @endif
                        </td>
                        <td>
                            {{ $keterangan }}
                            @php
                                if ($ketSof != '' and $keterangan != '') {
                                    echo ', ' . $ketSof;
                                } else {
                                    echo $ketSof;
                                }
                            @endphp

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
