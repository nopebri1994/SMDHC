<html>

<head>
    <title>Laporan Advance</title>
    <style>
        /** Define the margins of your page **/
        @page {
            /* margin: 100px 25px; */
            margin-top: 4cm;
            margin-botom: 1.3cm;
            margin-left: 1cm;
            margin-right: 1cm
        }

        header {
            position: fixed;
            top: -3.2cm;
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
            border-bottom: 0px;
            border-top: 1px solid #000000;
            border-collapse: collapse;
            font-size: 12px;
        }

        main>table>thead>tr,
        th {
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
            border-collapse: collapse;
            text-align: center;

        }

        th.bts {
            border-top: 1px solid #000000;
            border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;
            border-collapse: collapse;

        }

        td.bts {
            border-top: 1px solid #000000;
            border-right: 1px solid #000000;
            border-bottom: 0px solid #000000;
            /* border-style: dotted; */
            border-collapse: collapse;
            font-size: 10px;
            text-align: center;

        }

        td.nr {
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
            border-bottom: 1px solid #000000;
            border-style: dotted;
            border-collapse: collapse;
            text-align: center;
            font-size: 10px;
        }

        tr.nd {
            border-left: 0px;
            border-right: 0px;
            border-bottom: 1px solid #000000;
            /* border-collapse: collapse; */
            border-style: dotted;

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
                        LAPORAN <i>ADVANCE</i> KARYAWAN / WATI</b>
                </td>
            </tr>
            <tr>
                <td align='center'>
                    Bulan : $namabln, $year
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
        <table width="100%" class="tabel">
            <thead>
                <tr>
                    <th class="">
                        No.
                    </th>
                    <th>
                        N.I.K.
                    </th>
                    <th>
                        Nama Karyawan
                    </th>
                    <th>
                        Dept / Bagian
                    </th>
                    <th style="word-break:break-all;" width="10px">
                        No. Advance
                    </th>
                    <th>
                        Realisasi Advance
                    </th>
                    <th class="bts">
                        Tanggal Realisasi
                    </th>
                    <th>
                        Open Balance
                    </th>
                    <th>
                        Jumlah Potongan
                    </th>
                    <th class="">
                        Potongan Ke
                    </th>
                    <th>
                        Jumlah Dibayarkan
                    </th>
                    <th>
                        Sisa / Close Balance
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td class="nr">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="bts">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                    <td class="">1</td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="nd">
                    <td style="text-align: center" colspan="5"><b>Total</b></td>
                    <td class=""></td>
                    <td class="bts"></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                </tr>
            </tfoot>
        </table>
    </main>
</body>

</html>
