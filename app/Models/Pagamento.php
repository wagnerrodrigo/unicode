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
        $query = "SELECT * FROM intranet.tab_despesa where fk_status_despesa_id = ? ";

        $pagamento = DB::select($query, [config('constants.PAGO')]);

        return $pagamento;
    }

    static function findOne()
    {
    
    }

    

}
