<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagamento extends Model
{
    use HasFactory;

    static function selectAll()
    {
        $query = "SELECT * FROM intranet.tab_pagamento";

        $pagamento = DB::select($query);
        return $pagamento;
    }

    static function findOne()
    {
    
    }

    
}
