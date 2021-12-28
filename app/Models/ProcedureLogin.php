<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProcedureLogin extends Model
{
    use HasFactory;

    private $login;
    private $password;
    public $procedureResult;

    public function __construct($login, $password)
    {
        //$conn = database('pgsql', 'myUsername', 'myPass', 'Vendor', 'PostgreSQL');
        $this->login = $login;
        $this->password = $password;

        //$procedure = DB::select("select * from usu_13.check_login_v2('$this->cpf', '$this->password') as (nome VARCHAR, login VARCHAR, senha VARCHAR, email VARCHAR)");

        $procedure = DB::connection('pgsql_login')->select("SELECT usu_13.check_login_v2('$this->login','$this->password')");

        $this->procedureResult = $procedure;

        return $this->procedureResult;
    }
}
