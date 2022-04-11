<?php

namespace App\Utils;

class FormataValor
{
    static function Real($valor)
    {

        $valor = str_replace("R$", "", $valor);
        $valor = trim(html_entity_decode($valor), " \t\n\r\0\x0B\xC2\xA0");
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);

        return $valor;
    }
}
