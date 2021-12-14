<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nome_generico',
        'tipo',
        'forma_produto',
        'data_fim'
    ];

    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_produto;";
        $classificacaoProduto = DB::select($query);

        return $classificacaoProduto;
    }

    static function selectById($id)
    {
        $query = DB::select("SELECT 
        id_produto, 
		de_produto, 
		fk_tab_tipo_produto_id 
        FROM intranet.tab_produto
        LEFT JOIN intranet.tab_tipo_produto on fk_tab_tipo_produto_id = id_tipo_produto
        WHERE fk_tab_tipo_produto_id = ?;",[$id]);
        $classificacaoProduto =  $query[0];
        
        return $classificacaoProduto;
    }

}
