<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Extrato extends Model
{
    use HasFactory;


    static function findByCompany()
    {
        $query = DB::select("SELECT * FROM intranet.tab_empresa;");

        return $query;
    }

    static function selectAll()
    {
        $query = DB::select(" SELECT extrato.id_extrato,
                    extrato.fk_tab_conta_bancaria,
                    extrato.dtend,
                    extrato.balamt,
                    ct_bancaria.fk_tab_inst_banco_id,
                    ct_bancaria.nu_agencia,
                    ct_bancaria.nu_conta,
                    inst_banco.id,
                    inst_banco.de_banco,
                    empresa.id_empresa
                    FROM intranet.tab_extrato AS extrato
                    INNER JOIN intranet.tab_conta_bancaria AS ct_bancaria on (extrato.fk_tab_conta_bancaria = ct_bancaria.id_conta_bancaria)
                    INNER JOIN intranet.tab_inst_banco AS inst_banco on (ct_bancaria.fk_tab_inst_banco_id = inst_banco.id)
                    INNER JOIN intranet.tab_empresa AS empresa on (empresa.id_empresa = extrato.fk_empresa_id) LIMIT 5;");

        $data = $query;

        return $data;
    }


    static function findByPeriod()
    {
    }
}
