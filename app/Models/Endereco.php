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
        /*$enderecos = DB::select("SELECT
        id_endereco,
        logradouro,
        numero,
        bairro,
        complemento,
        fk_tab_cidade_id,
        fk_tab_uf_id,
        cep,
        fk_tab_fornecedor_id,
        fk_tab_empregado_id,
        fk_tab_empresa_id
        FROM intranet.tab_endereco INNER JOIN intranet.tab_empresa on fk_tab_empresa_id = id_empresa");*/

        $enderecos = DB::select("SELECT *
        FROM intranet.tab_endereco AS endereco
        JOIN intranet.tab_empresa AS empresa ON endereco.fk_tab_empresa_id = empresa.id_empresa
        JOIN intranet.tab_empregado AS empregado ON endereco.fk_tab_empregado_id = empregado.id_empregado
        JOIN intranet.tab_fornecedor AS fornecedor ON endereco.fk_tab_fornecedor_id = fornecedor.id_fornecedor");

        return $enderecos;
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
}
