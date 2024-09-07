<?php

class varHelper
{

    public static function formatDate($x)
    {
        $nDate = date('d-m-Y', strtotime($x));
        return $nDate;
    }

    public static function formatDateToHTML($x)
    {
        $nDate = date('m/d/Y', strtotime($x));
        return $nDate;
    }

    public static function varJK($x)
    {
        $tmp = '';
        if ($x == 1) {
            $tmp = 'Laki - Laki';
        } else {
            $tmp = 'Perempuan';
        }
        return $tmp;
    }
    public static function varStatusKaryawan($x)
    {
        $tmp = '';
        switch ($x) {
            case 1;
                $tmp = 'Kontrak';
                break;
            case 2;
                $tmp = 'Tetap';
                break;
            case 3;
                $tmp = 'Honerer';
                break;
            default:
                $tmp = 'Harian';
        }
        return $tmp;
    }
    public static function varCuti($x)
    {
        $tmp = [];
        switch ($x) {
            case 6;
                $tmp = [
                    'status'    => 'Cuti Panjang I A',
                    'hak'       => 25,
                ];
                break;
            case 7;
                $tmp = [
                    'status'    => 'Cuti Panjang I B',
                    'hak'       => 25,
                ];
                break;
            case 12;
                $tmp = [
                    'status'    => 'Cuti Panjang II A',
                    'hak'       => 25,
                ];
                break;
            case 13;
                $tmp = [
                    'status'    => 'Cuti Panjang II B',
                    'hak'       => 25,
                ];
                break;
                break;
            case 18;
                $tmp = [
                    'status'    => 'Cuti Panjang III A',
                    'hak'       => 25,
                ];
                break;
            case 19;
                $tmp = [
                    'status'    => 'Cuti Panjang III B',
                    'hak'       => 25,
                ];
                break;
            case 24;
                $tmp = [
                    'status'    => 'Cuti Panjang IV A',
                    'hak'       => 25,
                ];
                break;
            case 25;
                $tmp = [
                    'status'    => 'Cuti Panjang IV B',
                    'hak'       => 25,
                ];
                break;
            case 30;
                $tmp = [
                    'status'    => 'Cuti Panjang V A',
                    'hak'       => 25,
                ];
                break;
            case 31;
                $tmp = [
                    'status'    => 'Cuti Panjang V B',
                    'hak'       => 25,
                ];
                break;
            case 36;
                $tmp = [
                    'status'    => 'Cuti Panjang VI A',
                    'hak'       => 25,
                ];
                break;
            case 37;
                $tmp = [
                    'status'    => 'Cuti Panjang VI B',
                    'hak'       => 25,
                ];
                break;
            default:
                $tmp = [
                    'status'    => 'Cuti Tahunan',
                    'hak'       => 12,
                ];
        }
        return $tmp;
    }
    public static function varHutangCuti($x)
    {
        $tmp = [];
        switch ($x) {
            case 5;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang I A',
                    'hak'       => 25,
                ];
                break;
            case 6;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang I B',
                    'hak'       => 25,
                ];
                break;
            case 11;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang II A',
                    'hak'       => 25,
                ];
                break;
            case 12;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang II B',
                    'hak'       => 25,
                ];
                break;
                break;
            case 17;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang III A',
                    'hak'       => 25,
                ];
                break;
            case 18;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang III B',
                    'hak'       => 25,
                ];
                break;
            case 23;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang IV A',
                    'hak'       => 25,
                ];
                break;
            case 24;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang IV B',
                    'hak'       => 25,
                ];
                break;
            case 29;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang V A',
                    'hak'       => 25,
                ];
                break;
            case 30;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang V B',
                    'hak'       => 25,
                ];
                break;
            case 35;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang VI A',
                    'hak'       => 25,
                ];
                break;
            case 36;
                $tmp = [
                    'status'    => 'Hutang Cuti Panjang VI B',
                    'hak'       => 25,
                ];
                break;
            default:
                $tmp = [
                    'status'    => 'Hutang Cuti Tahunan',
                    'hak'       => 12,
                ];
        }
        return $tmp;
    }

    public static function bulanIndo($x)
    {
        switch ($x) {
            case 'January';
                $tmp = 'Januari';
                break;
            case 'February';
                $tmp = 'Februari';
                break;
            case 'March';
                $tmp = 'March';
                break;
            case 'April';
                $tmp = 'April';
                break;
            case 'May';
                $tmp = 'Mei';
                break;
            case 'June';
                $tmp = 'Juni';
                break;
            case 'July';
                $tmp = 'Juli';
                break;
            case 'August';
                $tmp = 'Agustus';
                break;
            case 'September';
                $tmp = 'September';
                break;
            case 'October';
                $tmp = 'Oktober';
                break;
            case 'November';
                $tmp = 'November';
                break;
            default:
                $tmp = 'Desember';
        }
        return $tmp;
    }

    static public function hariIndo($x)
    {
        switch ($x) {
            case 'Sunday';
                $tmp = 'Minggu';
                break;
            case 'Monday';
                $tmp = 'Senin';
                break;
            case 'Tuesday';
                $tmp = 'Selasa';
                break;
            case 'Wednesday';
                $tmp = 'Rabu';
                break;
            case 'Thursday';
                $tmp = 'Kamis';
                break;
            case 'Friday';
                $tmp = 'Jumat';
                break;
            default:
                $tmp = 'Sabtu';
        }
        return $tmp;
    }
    public static function m($x)
    {
        switch ($x) {
            case '1';
                $tmp = 'Januari';
                break;
            case '2';
                $tmp = 'Februari';
                break;
            case '3';
                $tmp = 'March';
                break;
            case '4';
                $tmp = 'April';
                break;
            case '5';
                $tmp = 'Mei';
                break;
            case '6';
                $tmp = 'Juni';
                break;
            case '7';
                $tmp = 'Juli';
                break;
            case '8';
                $tmp = 'Agustus';
                break;
            case '9';
                $tmp = 'September';
                break;
            case '10';
                $tmp = 'Oktober';
                break;
            case '11';
                $tmp = 'November';
                break;
            default:
                $tmp = 'Desember';
        }
        return $tmp;
    }
}
