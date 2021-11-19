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
        'dt_fim',
        'de_nome_fantasia'
    ];

    //Ao passar parametros, se atentar a ordem que é passado na query
    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_fornecedor";
        $fornecedores = DB::select($query);

        return $fornecedores;
    }

    static function create($fornecedor)
    {
        DB::insert("insert into intranet.tab_fornecedor 
        (nu_cpf_cnpj,de_razao_social,inscricao_estadual,dt_inicio,dt_fim,de_nome_fantasia) 
        values (?, ?, ?, ?, null, ? )", [
            $fornecedor->nu_cpf_cnpj,
            $fornecedor->de_razao_social,
            $fornecedor->inscricao_estadual,
            $fornecedor->dt_inicio,
            $fornecedor->de_nome_fantasia,
        ]);
        //values(cnpj,razao_social,inscricao_estadual,dt_inicio,dt_fim,nome_fantasia)
    }

    static function findOne($id)
    {
        $data = DB::select("SELECT * FROM intranet.tab_fornecedor 
        WHERE id_fornecedor = ?;", [$id]);

        $fornecedor = $data[0];
        return $fornecedor;
    }

    static function set($fornecedor)
    {
        DB::update("UPDATE intranet.tab_fornecedor 
        SET de_razao_social = ?, inscricao_estadual = ?, dt_inicio = ?, de_nome_fantasia = ?
        WHERE id_fornecedor = ?", [
            $fornecedor->de_razao_social,
            $fornecedor->inscricao_estadual,
            $fornecedor->dt_inicio,
            $fornecedor->de_nome_fantasia,
            $fornecedor->id_fornecedor
        ]);
    }

    static function buscaCnpjCpf($nu_cpf_cnpj){
        $data = DB::select("SELECT * FROM intranet.tab_fornecedor 
        WHERE nu_cpf_cnpj LIKE'%" . $nu_cpf_cnpj . "%'");

        
        $fornecedor = $data;
        return $fornecedor;
    }

    static function del($dataFim, $id)
    {
        DB::update("UPDATE intranet.tab_fornecedor 
        SET dt_fim = ?
        WHERE id_fornecedor = ?", [$dataFim, $id]);
    }
}
