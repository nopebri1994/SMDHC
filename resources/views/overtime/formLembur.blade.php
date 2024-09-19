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
                    <table style='border-collapse: collapse;'>
                        <tr>
                            <td style='font-size:12px;padding-top:10px;padding-left:5px;'>
                                <u>PT. Lion Metal Works Tbk</u>
                            </td>
                        </tr>
                        <tr>
                            <td style='font-size:12px;padding-left:5px;'>
                                Human Capital Dept.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table width='100%'>
            <tr>
                <td align='center'><b>
                        PERMOHONAN & REALISASI LEMBUR
                </td>
            </tr>
            <tr>
                <table width='35%' style="font-size: 12px" align="right">

                    <tr>
                        <td>
                            Bagian
                        </td>
                        <td>
                            :
                        </td>
                        <td> Fabrikasi 1</td>
                        <td>
                            Hari
                        </td>
                        <td>
                            :
                        </td>
                        <td>Senin</td>
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
                        <td>:</td>
                        <td>1</td>
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
                    <th style="width: 10%;" rowspan="2">
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
                    <th>URUT</th>
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
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
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
