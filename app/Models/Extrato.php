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
        return DB::table('intranet.tab_extrato')
        
            ->where('tab_extrato.trnamt', '<', '0')

            ->join('intranet.tab_conta_bancaria', 
            'tab_extrato.fk_tab_conta_bancaria', 
            '=', 
            'tab_conta_bancaria.id_conta_bancaria')
            
            ->orderBy('id_extrato', 'desc')
            ->paginate(10);
    }

    static function selectAllConta()
    {
        return DB::table('intranet.tab_conta_bancaria')
        ->distinct('id_conta_bancaria')
            ->join(
                'intranet.tab_inst_banco', 
                'tab_inst_banco.id', 
                '=', 
                'tab_conta_bancaria.fk_tab_inst_banco_id')

            ->join(
                'intranet.tab_rateio_pagamento', 
                'tab_rateio_pagamento.fk_tab_conta_bancaria', 
                '=', 
                'tab_conta_bancaria.id_conta_bancaria')

            ->orderBy('id_conta_bancaria', 'desc')
            ->paginate();
    }
    

    static function findByExtract($id)
    {

        $query = DB::table('intranet.tab_extrato')
            ->join(
                'intranet.tab_conta_bancaria',
                'intranet.tab_conta_bancaria.id_conta_bancaria',
                '=',
                'intranet.tab_extrato.fk_tab_conta_bancaria'
            )
            ->join(
                'intranet.tab_rateio_pagamento',
                'intranet.tab_rateio_pagamento.fk_tab_conta_bancaria',
                '=',
                'intranet.tab_extrato.fk_tab_conta_bancaria'
            )
            ->join(
                'intranet.tab_lancamento',
                'intranet.tab_lancamento.id_tab_lancamento',
                '=',
                'intranet.tab_rateio_pagamento.fk_tab_lancamento'
            )
            ->where(
                'intranet.tab_lancamento.id_tab_lancamento',
                '=',
                $id
            )
            ->get();
        return $query;
    }

    static function findByBankAccountAndDate($id_conta, $dt_pagamento = null)
    {
        $query = "SELECT * FROM intranet.tab_extrato WHERE intranet.tab_extrato.fk_tab_conta_bancaria = $id_conta AND intranet.tab_extrato.dtposted = '$dt_pagamento'";

        return DB::select($query);
    }


    static function findByIdAccount(String $id)
    {
        return DB::table('intranet.tab_extrato')
            ->where('tab_extrato.trnamt', '<', '0')->where('tab_extrato.fk_tab_conta_bancaria', '=', $id)
            ->join('intranet.tab_conta_bancaria', 'tab_extrato.fk_tab_conta_bancaria', '=', 'tab_conta_bancaria.id_conta_bancaria')
            ->orderBy('id_extrato', 'desc')
            ->paginate(10);
    }
}
