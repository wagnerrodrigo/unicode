<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'nu_cpf_cnpj',
        'de_razao_social',
        'inscricao_estatual',
        'dt_inicio',
        'dt_fim'
    ];

    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_fornecedor";
        $fornecedores = DB::select($query);

        return $fornecedores;
    }

    static function create($fornecedor)
    {
        $query = sprintf(
            "INSERT INTO intranet.tab_fornecedor
            (nu_cpf_cnpj, de_razao_social, inscricao_estadual, dt_inicio, dt_fim)
            VALUES('%s','%s',%s,'%s',null);",
            $fornecedor->nu_cpf_cnpj,
            $fornecedor->de_razao_social,
            $fornecedor->inscricao_estadual,
            $fornecedor->dt_inicio,
        );

        DB::insert($query);
    }

    static function findOne($id){
        $query = sprintf(
            "SELECT * FROM intranet.tab_fornecedor WHERE id_fornecedor = %s;",
            $id
        );

        //dd($query);
        
        $fornecedor = DB::select($query);

        dd($fornecedor);

        return $fornecedor;
    }
}
