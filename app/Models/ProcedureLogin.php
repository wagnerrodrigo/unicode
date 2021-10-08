<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcedureLogin extends Model
{
    use HasFactory;

    private $cpf;
    private $password;
    public $procedureResult;

    public function __construct($cpf, $password)
    {
        $this->cpf = $cpf;
        $this->password = $password;

        //retorna vazio ou informações de login
        $procedure = DB::select("select * from usu_13.check_login_v2('$this->cpf', '$this->password') as (nome VARCHAR, login VARCHAR, senha VARCHAR, email VARCHAR)");

        foreach ($procedure as $proc) {
            $this->procedureResult = $proc;
        }
        return $this->procedureResult;
    }
}
