<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaContaBancaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_bancarias',function (Blueprint $table){
            $table->id();
            $table->string('instituicao_bancaria');
            $table->string('numero_conta')->unique();
            $table->string('digito_conta');
            $table->string('tipo_conta');
            $table->string('titular');
            $table->string('situacao');
            $table->string('descricao', 64);
            $table->timestamps();
            $table->timestamp('data_fim')->nullable();
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
