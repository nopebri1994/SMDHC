<?php

class varHelper
{

    public static function formatDate($x)
    {
        $nDate = date('d-m-Y', strtotime($x));
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
}
