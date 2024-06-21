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
}
