<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'endereco';

    protected $fillable = [
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'fk_tab_cidade_id',
        'fk_tab_uf_id',
        'cep',
        'fk_tab_empregado_id',
        'dt_inicio',
        'dt_fim',
        'fk_tab_empresa_id',
    ];


    static function selectAll()
    {
        $enderecos = DB::select("SELECT *
        FROM intranet.tab_endereco AS endereco
        JOIN intranet.tab_empresa AS empresa ON endereco.fk_tab_empresa_id = empresa.id_empresa
        JOIN intranet.tab_empregado AS empregado ON endereco.fk_tab_empregado_id = empregado.id_empregado
        JOIN intranet.tab_fornecedor AS fornecedor ON endereco.fk_tab_fornecedor_id = fornecedor.id_fornecedor");

        return $enderecos;
    }

    static function create($endereco)
    {
        DB::insert("INSERT INTO intranet.tab_endereco
        (
            fk_tipo_endereco_id,
            fk_tipo_logradouro,
            logradouro,
            numero,
            bairro,
            cep,
            fk_tab_cidade_id,
            fk_tab_uf_id,
            complemento,
            dt_inicio,
            fk_tab_fornecedor_id
        )VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
            $endereco->fk_tipo_endereco_id,
            $endereco->fk_tipo_logradouro,
            $endereco->logradouro,
            $endereco->numero,
            $endereco->bairro,
            $endereco->cep,
            $endereco->fk_tab_cidade_id,
            $endereco->fk_tab_uf_id,
            $endereco->complemento,
            $endereco->dt_inicio,
            $endereco->fk_tab_fornecedor_id
        ]);
    }

    static function empresa()
    {
        $enderecos = DB::select("SELECT *
        FROM intranet.tab_endereco AS endereco
        JOIN intranet.tab_cidade AS cidade ON endereco.fk_tab_cidade_id = cidade.id_cidade
        JOIN intranet.tab_uf AS uf ON endereco.fk_tab_uf_id = uf.id_uf
        JOIN intranet.tab_empresa AS empresa ON endereco.fk_tab_empresa_id = empresa.id_empresa");

        return $enderecos;
    }

    static function findOne($id)
    {
        $data = DB::select("SELECT *
        FROM intranet.tab_endereco AS endereco
        JOIN intranet.tab_cidade AS cidade ON endereco.fk_tab_cidade_id = cidade.id_cidade
        JOIN intranet.tab_uf AS uf ON endereco.fk_tab_uf_id = uf.id_uf
        JOIN intranet.tab_empresa AS empresa ON endereco.fk_tab_empresa_id = empresa.id_empresa
        WHERE endereco.id_endereco = $id");

        $endereco = $data[0];
        return $endereco;
    }

    static function findByProvider($provider_id)
    {
        $addresses = DB::select("SELECT *
        FROM intranet.tab_endereco AS endereco
        JOIN intranet.tab_cidade AS cidade ON endereco.fk_tab_cidade_id = cidade.id_cidade
        JOIN intranet.tab_uf AS uf ON endereco.fk_tab_uf_id = uf.id_uf
        JOIN intranet.tab_fornecedor AS fornecedor ON endereco.fk_tab_fornecedor_id = fornecedor.id_fornecedor
        WHERE fornecedor.id_fornecedor = $provider_id AND endereco.dt_fim IS NULL");

        return $addresses;
    }

    static function edit($id, $endereco)
    {
        DB::update("UPDATE intranet.tab_endereco
        SET numero = ?,
        complemento = ?
        WHERE id_endereco = ?", [
            $endereco->numero,
            $endereco->complemento,
            $id
        ]);
    }

    static function setEndDate($id, $date)
    {
        DB::update("UPDATE intranet.tab_endereco
        SET dt_fim = ?
        WHERE id_endereco = ? ", [
            $date,
            $id
        ]);
    }
}
