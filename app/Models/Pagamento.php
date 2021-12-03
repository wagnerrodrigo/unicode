<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagamento extends Model
{
    use HasFactory;

    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_pagamento";

        $pagamento = DB::select($query);
        return $pagamento;
    }

    static function findOne()
    {
    
    }

    static function showInfoAccount($info){
        $query = ("SELECT
                 id, co_banco, de_banco
                 FROM intranet.intranet.tab_inst_banco
                 WHERE de_banco LIKE upper('%".$info."%')");

        $pagamento = DB::select($query);
        return $pagamento;
    }

    static function showInfoAgency($id)
    {
        $query = DB::select("SELECT conta_banco.fk_tab_inst_banco_id,
                   conta_banco.nu_agencia
                   fROM intranet.tab_conta_bancaria AS conta_banco
                   JOIN intranet.tab_inst_banco AS ins_bank ON(ins_bank.id = conta_banco.fk_tab_inst_banco_id)
                   WHERE ins_bank.id = ?;", [$id]);
       
        return $query;
    }

    static function showInfoBankAccount($id)
    {
        $query = DB::select("SELECT 
                    conta_banco.fk_tab_inst_banco_id,
                    conta_banco.nu_conta
                    FROM intranet.tab_conta_bancaria AS conta_banco
                    JOIN intranet.tab_inst_banco AS ins_bank ON(ins_bank.id = conta_banco.fk_tab_inst_banco_id)
                    WHERE ins_bank.id = ?", [$id]);

        return $query;
    }
    
}
