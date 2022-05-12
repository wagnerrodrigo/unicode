<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

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
        )->where('tab_parcela_despesa.fk_despesa', $idDespesa)->orderBy('num_parcela', 'asc')->get();
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
            )->where('id_parcela_despesa', $idParcela)->first();
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
}
