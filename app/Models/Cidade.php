<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['no_cidade','dt_inicio', 'dt_fim', 'fk_tab_uf_id'];

}
