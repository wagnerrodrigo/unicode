<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cidade extends Model
{
    use HasFactory;

    static function findIdByCidade($cidade){
        $city = DB::select("SELECT id_cidade FROM intranet.tab_cidade WHERE no_cidade = ?", [$cidade]);

        return $city[0]->id_cidade;
    }
}
