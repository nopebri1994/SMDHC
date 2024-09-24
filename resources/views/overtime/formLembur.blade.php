asas
<html>

<head>
    <title>Form Lembur</title>
    <style>
        /** Define the margins of your page **/
        @page {
            /* margin: 100px 25px; */
            margin-top: 4.5cm;
            margin-botom: 1.3cm;
            margin-left: 1cm;
            margin-right: 1cm
        }

        header {
            position: fixed;
            top: -3.5cm;
            left: 0px;
            right: 0px;
        }

        footer {
            position: fixed;
            bottom: -1cm;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 12px;
        }

        .head {
            text-align: center;
            font-size: 20px;
            padding-bottom: 24px
        }

        .center {
            text-align: center;
        }

        main {
            font-size: 12px;
        }

        .tabel {
            border-collapse: collapse;
            font-size: 12px;
            border: 1px solid;
        }

        th {
            border: 1.5px solid #000000;
        }

        main>table>tbody>tr>td {
            border: 1px solid #000000;
        }

        main>table>tfoot>tr>td {
            text-align: center;
        }

        .left {
            border-left: 1px solid #000000;
        }
    </style>
</head>

<body>
    <header style="height:300px">
        <table width='100%' border='0'>
            <tr>
                <td width='8%'>
                    <img src="{{ public_path('/') }}/assets/img/logo.png" width='85' height='35'>
                </td>
                <td>
                    <table width="70%" style='border-collapse: collapse;'>
                        <tr>
                            <td style='font-size:12px;padding-top:10px;padding-left:5px;'>
                                <u>PT. Lion Metal Works Tbk</u>
                            </td>
                        </tr>
                        <tr>
                            <td style='font-size:12px;padding-left:5px;'>
                                Human Capital Dept.
                            </td>
                            <td style="text-align:center">
                                <b>PERMOHONAN & REALISASI LEMBUR</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table width='100%'>
            <tr>
                <table width='100%' style="font-size: 12px">

                    <tr>
                        <td>
                            Bagian
                        </td>
                        <td width="2%">
                            :
                        </td>
                        <td width='75%'>{{ $form->bagian->namaBagian }}</td>
                        <td>
                            Hari
                        </td>
                        <td>
                            :
                        </td>
                        <td>{{ varHelper::hariIndo(date('l', strtotime($form->tanggalOT))) }}</td>
                    </tr>
                    <tr>
                        <td>
                            Shift
                        </td>
                        <td>:</td>
                        <td>1</td>
                        <td>
                            Tanggal
                        </td>
                        <td width="2%">:</td>
                        <td>{{ varHelper::formatDate($form->tanggalOT) }}</td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            Halaman
                        </td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
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
        <table width="100%" class="tabel">
            <thead>
                <tr>
                    <th class="" colspan="2">
                        N0
                    </th>
                    <th style="width: 15%;" rowspan="2">
                        NAMA KARYAWAN
                    </th>
                    <th style="width: 30%;" rowspan="2">
                        JENIS PEKERJAAN
                    </th>
                    <th style="word-break:break-all;" colspan="3">
                        PERMOHONAN LEMBUR (PKL)
                    </th>
                    <th colspan="3">
                        REALISASI LEMBUR (PKL)
                    </th>
                </tr>
                <tr>
                    <th width="3%">URUT</th>
                    <th>KERJA</th>
                    <th>DARI</th>
                    <th>SAMPAI</th>
                    <th>PARAF</th>
                    <th>DARI</th>
                    <th>SAMPAI</th>
                    <th>TOTAL JAM</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $abs = collect($absensi);
                @endphp
                @foreach ($data as $key => $d)
                    @php
                        $detailAbsensi = $abs->firstWhere('idKaryawan', $d->idKaryawan);
                        $h = $d->jam1 + $d->jam2;
                    @endphp
                    <tr>
                        <td style="text-align: center">{{ $key + 1 }}</td>
                        <td style="text-align: center">{{ $d->karyawan->nikKerja }}</td>
                        <td>{{ $d->karyawan->namaKaryawan }}</td>
                        <td>{{ $d->jenisPekerjaan }}</td>
                        <td style="text-align: center">
                            {{ date('H:i', strtotime($d->jamMulai)) }}
                        </td>
                        <td style="text-align: center">
                            {{ date('H:i', strtotime("+$h Hours", strtotime($d->jamMulai))) }}
                        </td>
                        <td></td>
                        @if ($d->status == 2)
                            <td style="text-align: center">
                                @if ($detailAbsensi)
                                    {{ date('H:i', strtotime('+30 minutes', strtotime($detailAbsensi['jadwalPulang']))) }}
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if ($detailAbsensi)
                                    {{ date('H:i', strtotime($detailAbsensi['jamPulang'])) }}
                                @endif
                            </td>
                            <td style="text-align: center">{{ $h }} Jam</td>
                        @else
                            <td style="text-align: center; background-color:#55535363" colspan="3">

                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td class="left"></td>
                    <td colspan="3" class="left"><b>Permohonan</b></td>
                    <td colspan="3" class="left"><b>Realisasi</b></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">Pemasukan Data</td>
                    <td class="left">Diketahui:</td>
                    <td class="left">Dibuat :</td>
                    <td></td>
                    <td>Disetujui :</td>
                    <td class="left">Dibuat :</td>
                    <td></td>
                    <td>Disetujui :</td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 40px"></td>
                    <td class="left"></td>
                    <td colspan="3" class="left"></td>
                    <td colspan="3" class="left"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-decoration:overline">Staf Payroll</td>
                    <td class="left" style="text-decoration:overline">HC Manager</td>
                    <td class="left" style="text-decoration:overline">SPV/KaBag</td>
                    <td></td>
                    <td style="text-decoration:overline">Mgr Dept.</td>
                    <td class="left" style="text-decoration:overline">SPV/KaBag</td>
                    <td></td>
                    <td style="text-decoration:overline">Mgr Dept.</td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>

</html>
