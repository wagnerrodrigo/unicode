<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lancamento extends Model
{
    use HasFactory;

    static function selectAll()
    {
        $query = "SELECT lancamento.id_tab_lancamento,
        lancamento.fk_condicao_pagamento_id,
        lancamento.dt_vencimento,
        lancamento.dt_fim,
        despesa.id_despesa,
	    despesa.de_despesa,
        despesa.valor_total_despesa,
        despesa.dt_vencimento,
        despesa.dt_provisionamento,
        pagamento.fk_tab_lancamento_id,
        pagamento.de_pagamento
        FROM intranet.tab_lancamento AS lancamento
        RIGHT JOIN intranet.tab_despesa as despesa on (lancamento.fk_tab_despesa_id = despesa.id_despesa) 
        LEFT JOIN intranet.tab_pagamento as pagamento on (despesa.id_despesa = pagamento.fk_tab_lancamento_id)";
        
        $lancamentos = DB::select($query);

        return $lancamentos;
    }

    static function findOne($id){
        $data = DB::select("SELECT lancamento.id_tab_lancamento,
        lancamento.fk_condicao_pagamento_id,
        lancamento.dt_vencimento,
        lancamento.dt_fim,
        despesa.id_despesa,
        despesa.de_despesa,
        despesa.valor_total_despesa,
        despesa.dt_vencimento,
        despesa.dt_provisionamento,
        pagamento.fk_tab_lancamento_id,
        pagamento.de_pagamento
        FROM intranet.tab_lancamento AS lancamento
        RIGHT JOIN intranet.tab_despesa AS despesa ON (lancamento.fk_tab_despesa_id = despesa.id_despesa) 
        LEFT JOIN intranet.tab_pagamento AS pagamento ON (despesa.id_despesa = pagamento.fk_tab_lancamento_id)
        WHERE despesa.id_despesa = ?;",[$id]);
    
        $lancamento = $data[0];

        return $lancamento;

    }
    static function showInfoAccount($info){
        $query = ("SELECT conta_banco.fk_tab_inst_banco_id,
        conta_banco.nu_agencia,
        conta_banco.nu_conta,
        ins_bank.de_banco
        FROM intranet.tab_conta_bancaria AS conta_banco
        JOIN intranet.tab_inst_banco AS ins_bank ON(ins_bank.id = conta_banco.fk_tab_inst_banco_id)
        WHERE ins_bank.de_banco LIKE upper('%".$info."%');");

        $lancamento = DB::select($query);
        return $lancamento;
    }



}
