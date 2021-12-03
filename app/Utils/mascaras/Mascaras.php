<?php

namespace App\Utils\Mascaras;

class Mascaras
{
    static function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    static function maskMoeda($val)
    {
        return 'R$ '.number_format($val, 2, ',', '.');
    }

    static function maskPercentual($val)
    {
        return number_format($val, 2, ',', '.').'%';
    }
}
