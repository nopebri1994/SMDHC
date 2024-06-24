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
}
