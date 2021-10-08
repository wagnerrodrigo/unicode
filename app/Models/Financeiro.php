<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Financeiro extends Model
{
    use HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libera_pagamento',
        'data_pagto',
        'compra', 
        'cotacao',
        
    ];
}
 

