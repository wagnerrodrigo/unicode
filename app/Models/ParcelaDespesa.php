<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Utils\StatusDespesa;

class ParcelaDespesa extends Model
{
    use HasFactory;

    protected $fillable = [
        "fk_despesa",
        "num_parcela",
        "valor_parcela",
        "dt_emissao",
        "dt_vencimento",
        "dt_provisionamento",
        "fk_status_id",
        "fk_condicao_pagamento",
        "fk_conta_bancaria",
        "fk_pix_id",
        "dt_inicio",
        "dt_fim"
    ];

    static function store(ParcelaDespesa $parcelaDespesa)
    {
        DB::insert("INSERT INTO intranet.tab_parcela_despesa
        (
            fk_despesa,
            num_parcela,
            valor_parcela,
            dt_emissao,
            dt_vencimento,
            dt_provisionamento,
            fk_status_id,
            fk_condicao_pagamento,
            fk_conta_bancaria,
            fk_pix_id,
            dt_inicio,
            dt_fim
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $parcelaDespesa->fk_despesa,
            $parcelaDespesa->num_parcela,
            $parcelaDespesa->valor_parcela,
            $parcelaDespesa->dt_emissao,
            $parcelaDespesa->dt_vencimento,
            $parcelaDespesa->dt_provisionamento,
            $parcelaDespesa->fk_status_id,
            $parcelaDespesa->fk_condicao_pagamento,
            $parcelaDespesa->fk_conta_bancaria,
            $parcelaDespesa->fk_pix_id,
            $parcelaDespesa->dt_inicio,
            $parcelaDespesa->dt_fim
        ]);
    }


    static function parcelasDespesa($idDespesa)
    {
        return DB::table('intranet.tab_parcela_despesa')->select(
            'tab_parcela_despesa.id_parcela_despesa',
            'tab_parcela_despesa.fk_despesa',
            'tab_parcela_despesa.num_parcela',
            'tab_parcela_despesa.valor_parcela',
            'tab_parcela_despesa.dt_emissao',
            'tab_parcela_despesa.dt_vencimento',
            'tab_parcela_despesa.dt_provisionamento',
            'status_despesa.de_status_despesa',
            'tab_parcela_despesa.fk_condicao_pagamento',
            'tab_parcela_despesa.fk_conta_bancaria',
            'tab_parcela_despesa.fk_pix_id'
        )->join(
            'intranet.status_despesa',
            'tab_parcela_despesa.fk_status_id',
            '=',
            'intranet.status_despesa.id_status_despesa'
        )
            ->where('tab_parcela_despesa.fk_despesa', $idDespesa)->orderBy('num_parcela', 'asc')->get();
    }

    static function parcela($idParcela)
    {
        return DB::table('intranet.tab_parcela_despesa')
            ->select(
                "tab_parcela_despesa.id_parcela_despesa",
                "tab_parcela_despesa.fk_despesa",
                "tab_parcela_despesa.num_parcela",
                "tab_parcela_despesa.valor_parcela",
                "tab_parcela_despesa.dt_emissao",
                "tab_parcela_despesa.dt_vencimento",
                "tab_parcela_despesa.dt_provisionamento",
                "status_despesa.de_status_despesa",
                "tab_parcela_despesa.fk_condicao_pagamento",
                "tab_parcela_despesa.fk_conta_bancaria",
                "tab_parcela_despesa.fk_pix_id",
                "tab_parcela_despesa.dt_inicio",
                "tab_parcela_despesa.dt_fim"
            )
            ->join(
                'intranet.status_despesa',
                'tab_parcela_despesa.fk_status_id',
                '=',
                'intranet.status_despesa.id_status_despesa'
            )
            ->where('fk_status_id', '!=', StatusDespesa::PROVISIONADO)
            ->where('fk_status_id', '!=', StatusDespesa::PAGO)
            ->where('id_parcela_despesa', $idParcela)->first();
    }

    static function setParcela(ParcelaDespesa $parcela)
    {
        DB::table('intranet.tab_parcela_despesa')
            ->where('id_parcela_despesa', $parcela->id_parcela_despesa)
            ->update([
                'fk_status_id' => $parcela->fk_status_id,
                'dt_provisionamento' => $parcela->dt_provisionamento,
                'fk_condicao_pagamento' => $parcela->fk_condicao_pagamento,
                'fk_conta_bancaria' => $parcela->fk_conta_bancaria,
                'fk_pix_id' => $parcela->fk_pix_id,
            ]);
    }

    static function setProvisionDate($id, $date)
    {
        DB::table('intranet.tab_parcela_despesa')
            ->where('id_parcela_despesa', '=', $id)
            ->update(['dt_provisionamento' => $date]);
    }

    static function findByDueDate($date)
    {
        return DB::table('intranet.tab_parcela_despesa')
            ->where('fk_status_id', '=', StatusDespesa::A_PAGAR)->where('dt_vencimento', '<', $date)->get();
    }

    static function setStatusIfDefeaded($id)
    {
        DB::table('intranet.tab_parcela_despesa')
            ->where('id_parcela_despesa', '=', $id)
            ->update(['fk_status_id' => StatusDespesa::EM_ATRASO]);
    }

    static function setStatusIfPaid($id)
    {
        DB::table('intranet.tab_parcela_despesa')
            ->where('id_parcela_despesa', '=', $id)
            ->update(['fk_status_id' => StatusDespesa::PAGO]);
    }

    static function del($id, $date)
    {
        DB::update("UPDATE intranet.tab_parcela_despesa
        SET dt_fim = ?
        WHERE fk_despesa = ?", [$date, $id]);
    }

    static function cancelarParcelasAntigas($id)
    {
        DB::table('intranet.tab_parcela_despesa')
        ->where('fk_despesa', '=', $id)
        ->where('fk_status_id', '!=', StatusDespesa::PROVISIONADO)
        ->where('fk_status_id', '!=', StatusDespesa::PAGO)
        ->update(['fk_status_id' => StatusDespesa::REPARCELADO]);
    }
    
    static function AlterarStatusDespesaReparcela($id)
    {
        DB::table('intranet.tab_despesa')
        ->where('id_despesa', '=', $id)
        ->update(['fk_status_despesa_id' => StatusDespesa::REPARCELADO]);
    }


    static function addPayment($parcela, $idParcela)
    {
        DB::update(
            "UPDATE intranet.tab_parcela_despesa
        SET fk_condicao_pagamento = ?, fk_conta_bancaria = ?, fk_pix_id = ?, dt_provisionamento = ?
        WHERE id_parcela_despesa = ?",
            [
                $parcela->fk_condicao_pagamento,
                $parcela->fk_tab_conta_bancaria,
                $parcela->fk_pix_id,
                $parcela->dt_provisionamento,
                $idParcela
            ]
        );
    }

    static function setStatus($id_parcela_despesa)
    {
        DB::update(
            "UPDATE intranet.tab_parcela_despesa
            SET fk_status_id = 1
            WHERE id_parcela_despesa = ?",
            [$id_parcela_despesa]
        );
    }

    static function valorFaltante($id)
    {
        $parcela = DB::table('intranet.tab_parcela_despesa')
        ->select(DB::raw('SUM(tab_parcela_despesa.valor_parcela) as valor_parcela'))
        ->leftjoin(
            'intranet.tab_despesa',
            'intranet.tab_despesa.id_despesa',
            '=',
            'intranet.tab_parcela_despesa.fk_despesa'
        )
        
        ->where('intranet.tab_parcela_despesa.fk_despesa', $id)
        ->where('intranet.tab_parcela_despesa.dt_provisionamento', '=', null)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '!=', 3)
        
        ->get();
        return $parcela;
    }

    static function parcelasFaltante($id)
    {
        $parcela = DB::table('intranet.tab_parcela_despesa')
        ->select(DB::raw('count(tab_parcela_despesa.valor_parcela) as num_parcela'))
        ->leftjoin(
            'intranet.tab_despesa',
            'intranet.tab_despesa.id_despesa',
            '=',
            'intranet.tab_parcela_despesa.fk_despesa'
        )
        
        ->where('intranet.tab_parcela_despesa.fk_despesa', $id)
        ->where('intranet.tab_parcela_despesa.dt_provisionamento', '=', null)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '!=', 3)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '!=', 2)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '!=', 1)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '!=', 7)
        
        ->get();
        return $parcela;
    }

    static function TotalParcelas($id)
    {
        $parcela = DB::table('intranet.tab_parcela_despesa')
        ->select(DB::raw('count(tab_parcela_despesa.valor_parcela) as num_parcela'))
        ->leftjoin(
            'intranet.tab_despesa',
            'intranet.tab_despesa.id_despesa',
            '=',
            'intranet.tab_parcela_despesa.fk_despesa'
        )
        
        ->where('intranet.tab_parcela_despesa.fk_despesa', $id)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '=', 2)
        ->where('intranet.tab_parcela_despesa.fk_status_id', '=', 1)
        
        ->get();
        if($parcela){
            return $parcela[0];
        }
        return $parcela;
    }

    static function AlterarQuantidadeParcelaDespesa($id, $quantidadeParcela)
    {
        DB::table('intranet.tab_despesa')
        ->where('id_despesa', '=', $id)
        ->update(['qt_parcelas_despesa' => $quantidadeParcela]);
    }
}

