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


    static function selectAll(){
        DB::select("SELECT 
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
        dt_inicio, 
        dt_fim, 
        fk_tab_empresa_id
        FROM intranet.tab_endereco;");
    }

    
}
