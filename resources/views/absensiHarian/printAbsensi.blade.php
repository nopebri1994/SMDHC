<html>

<head>
    <style>
        /** Define the margins of your page **/
        @page {
            /* margin: 100px 25px; */
            margin-top: 6cm;
            margin-botom: 1.8cm
        }

        header {
            position: fixed;
            top: -4cm;
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
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <header style="height:300px">
        <div class="head">Absensi Harian Karyawan</div>
        <table>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>......</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>......</td>
            </tr>
            <tr>
                <td>Dept. / Bagian</td>
                <td>:</td>
                <td>......</td>
            </tr>
            <tr>
                <td>Dari Tanggal</td>
                <td>:</td>
                <td>......</td>
            </tr>
            <tr>
                <td>Sampai Tanggal</td>
                <td>:</td>
                <td>......</td>
            </tr>
        </table>
        <hr>
    </header>

    <footer>
        <hr>
        Copyright &copy; <?php echo date('Y'); ?>
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
                    <th colspan="2">Jam Kerja</th>
                    <th rowspan="2">Ket. Ijin</th>
                </tr>
                <tr>
                    <th>Jadwal Masuk</th>
                    <th>Jadwal Pulang</th>
                    <th>Jam datang</th>
                    <th>Jam Pulang</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i < 32; $i++)
                    <tr>
                        <td class="center">{{ $i }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </main>
</body>

</html>
