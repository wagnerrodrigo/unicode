<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empregado extends Model
{
    use HasFactory;

    static function buscaCpf($nu_cpf_cnpj){
        $data = DB::select("SELECT * FROM intranet.tab_empregado
        WHERE nu_cpf_cnpj LIKE'%" . $nu_cpf_cnpj . "%'" );
        

        $fornecedor = $data;
        return $fornecedor;
    }
}
