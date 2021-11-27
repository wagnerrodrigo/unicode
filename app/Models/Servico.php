<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nome_generico',
        'tipo',
        'forma_servico',
        'data_fim'
    ];

    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_tipo_servico;";
        $classificacaoServico = DB::select($query);
        
        return $classificacaoServico;
    }

    static function selectById($id)
    {
        $query = "SELECT 
         id_servico, 
		de_servico, 
		fk_tab_tipo_servico_id 
        FROM intranet.tab_servico
        LEFT JOIN intranet.tab_tipo_servico on fk_tab_tipo_servico_id = id_tipo_servico
        WHERE fk_tab_tipo_servico_id = ?;";
        $classificacaoServico = DB::select($query,[$id]);
        
        return $classificacaoServico;
    }
  


}
