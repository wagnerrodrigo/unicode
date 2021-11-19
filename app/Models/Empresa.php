<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj_empresa',
        'de_empresa',
        'regiao_empresa',
        'dt_inicio',
        'dt_fim',
    ];

    //Ao passar parametros, se atentar a ordem que é passado na query
    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_empresa";
        $empresas = DB::select($query);

        return $empresas;
    }

    static function create($empresa)
    {
        DB::insert("insert into intranet.tab_empresa
        (cnpj_empresa,de_empresa,regiao_empresa,dt_inicio,dt_fim)
        values (?, ?, ?, ?, null)", [
            $empresa->cnpj_empresa,
            $empresa->de_empresa,
            $empresa->regiao_empresa,
            $empresa->dt_inicio,
        ]);
    }

    static function findOne($id)
    {
        $data = DB::select("SELECT * FROM intranet.tab_empresa
        WHERE id_empresa = ?;", [$id]);

        $empresa = $data[0];
        return $empresa;
    }

    static function findByName($nome)
    {
        $empresa = DB::select("SELECT id_empresa, cnpj_empresa,de_empresa,regiao_empresa FROM intranet.tab_empresa
        WHERE de_empresa like '%" . $nome . "%';");

        return $empresa;
    }

    static function findByCnpj($cnpj)
    {
        $empresa = DB::select("SELECT * FROM intranet.tab_empresa
        WHERE cnpj_empresa like '%" . $cnpj . "%';");

        return $empresa;
    }

    static function set($empresa)
    {
        DB::update("UPDATE intranet.tab_empresa
        SET cnpj_empresa = ?, de_empresa = ?, regiao_empresa = ?, dt_inicio = ?
        WHERE id_empresa = ?", [
            $empresa->cnpj_empresa,
            $empresa->de_empresa,
            $empresa->regiao_empresa,
            $empresa->dt_inicio,
            $empresa->id_empresa
        ]);
    }

    static function del($dataFim, $id)
    {
        DB::update("UPDATE intranet.tab_empresa
        SET dt_fim = ?
        WHERE id_empresa = ?", [$dataFim, $id]);
    }
}
