<?php

namespace App\Utils;

class CondicaoPagamentoId
{
    const BOLETO = 1;
    const PIX = 2;
    const DEPOSITO = 3;
    const CHEQUE = 4;
    const DINHEIRO = 5;
    const DOC = 6;
    const TED = 7;
    const TRANSFERENCIA = 8;
    const MIGRACAO = 9;

    function getId($string)
    {
        switch ($string) {
            case 'BOLETO':
                return $this::BOLETO;
                break;
            case 'PIX':
                return $this::PIX;
                break;
            case 'DEPÓSITO':
                return $this::DEPOSITO;
                break;
            case 'CHEQUE':
                return $this::CHEQUE;
                break;
            case 'DINHEIRO':
                return $this::DINHEIRO;
                break;
            case 'DOC':
                return $this::DOC;
                break;
            case 'TED':
                return $this::TED;
                break;
            case 'TRANSFERÊNCIA':
                return $this::TRANSFERENCIA;
                break;
            case 'MIGRAÇÃO':
                return $this::MIGRACAO;
                break;
        }
    }
}
