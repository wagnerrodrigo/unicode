<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InstituicaoFinanceira extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao_financeira',function (Blueprint $table){
            $table->id();
            $table->string('nome');
            $table->string('cnpj');
            $table->string('codigo');
            $table->string('numero_conta');
            $table->string('digito_conta');
            $table->string('agencia');
            $table->string('tipo_conta');
            $table->string('titular');
            $table->string('situacao');
            $table->string('razao_social');
            $table->string('descricao');
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
