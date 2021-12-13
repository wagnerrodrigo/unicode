<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Extrato extends Model
{
    use HasFactory;


    static function findByCompany()
    {
        $query = DB::select("SELECT * FROM intranet.tab_empresa;");

        return $query;

    }
}
