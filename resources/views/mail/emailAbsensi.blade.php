<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @media screen and (max-width: 600px) {
            .content {
                width: 100% !important;
                display: block !important;
                padding: 10px !important;
            }

            .table,
            .body {
                font-size: 10px !important;
            }

            .header,
            .footer {
                font-size: 12px !important;
            }

            .header,
            .body,
            .footer {
                padding: 20px !important;
            }
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
</head>

<body>

    <body style="font-family: 'Poppins', Arial, sans-serif">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center" style="padding: 20px;">
                    <table class="content" width="600" border="0" cellspacing="0" cellpadding="0"
                        style="border-collapse: collapse; border: 1px solid #cccccc;">
                        <!-- Header -->
                        <tr>
                            <td class="header"
                                style="background-color: #F56954; padding: 40px; text-align: center; color: white; font-size: 24px;">
                                Email Confirmation
                            </td>
                        </tr>

                        <!-- Body -->
                        <tr>
                            <td class="body"
                                style="padding: 40px; text-align: left; font-size: 16px; line-height: 1.6;">
                                Informasi Proses Absensi Karyawan <br>
                                Email ini dikirimkan setelah staf Human Capital melakukan proses input absensi anda.
                                <br><br>
                                <table style="font-size: 14px; margin:auto; width:100%" class="table">
                                    <tr>
                                        <td style="width:40%">NIK</td>
                                        <td style="">
                                            {{ $data['nik'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Karyawan</td>
                                        <td style="">
                                            {{ $data['nama'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Ijin</td>
                                        <td style="">
                                            {{ $data['tanggalIjin'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Proses Ijin</td>
                                        <td style="">
                                            {{ $data['tanggalProses'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan Ijin</td>
                                        <td style="">
                                            {{ $data['keteranganIjin'] }} ({{ $data['ket'] }})
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="body"
                                style="padding: 10px; text-align: center; font-size: 14px; line-height: 1.6;">
                                PT Lion Metal Works Tbk - Purwakarta / Human Capital Departemen.
                            </td>
                        </tr>
                        <!-- Footer -->
                        <tr>
                            <td class="footer"
                                style="background-color: #f14a31; padding: 40px; text-align: center; color: white; font-size: 14px;">
                                Copyright &copy; 2024 | GA/IT
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</body>

</html>
