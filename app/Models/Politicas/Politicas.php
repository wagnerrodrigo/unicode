<?php

namespace App\Models\Politicas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Politicas extends Model
{

    protected $fillable = [
        'remetente',
        'titulo_politica',
        'politica',
        'fk_tab_empregado_id',
        'fk_tab_arquivo_politica_id',
        'data_cadastro',
    ];

    static function salvarPolitica($documentacao)
    {
        DB::insert("INSERT INTO intranet.tab_politica
        (remetente,
        titulo_politica,
        politica,
        fk_tab_empregado_id,
        fk_tab_arquivo_politica_id,
        data_cadastro)
        VALUES (?, ?, ?, ?, ?, ?)
        ", [
            $documentacao->remetente,
            $documentacao->titulo_politica,
            $documentacao->politica,
            $documentacao->fk_tab_empregado_id,
            $documentacao->fk_tab_arquivo_politica_id,
            $documentacao->data_cadastro
        ]);
    }


    static function selectAll($results, $busca = null, $data = null)
    {
        $query = DB::table('intranet.tab_politica')
            ->select(
                'tab_politica.id_politica',
                'tab_politica.remetente',
                'tab_politica.titulo_politica',
                'tab_politica.politica',
                'tab_politica.fk_tab_empregado_id',
                'tab_politica.fk_tab_arquivo_politica_id',
                'tab_politica.data_cadastro'
            );
            

        if ($busca && !$data) {
            $politicas = $query
                ->where('intranet.tab_politica.remetente', 'LIKE', "%{$busca}%")
                ->orWhere('intranet.tab_politica.titulo_politica', 'LIKE', "%{$busca}%")

                ->orderBy('id_politica', 'desc')
                ->paginate($results);
        } else {
            $politicas = $query
                ->orderBy('id_politica', 'desc')

                ->paginate($results);
        }

        return $politicas;
    }

}
