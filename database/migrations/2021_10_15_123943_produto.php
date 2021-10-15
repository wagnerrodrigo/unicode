<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Produto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos',function (Blueprint $table){
            $table->id();
            $table->string('nome');
            $table->string('cnpj')->unique();
            $table->string('telefone');
            $table->string('email', 64)->unique();
            $table->string('inscricao_estadual');
            $table->string('ramo_atuacao');
            $table->string('ponto_contato');
            $table->string('cargo_funcao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
