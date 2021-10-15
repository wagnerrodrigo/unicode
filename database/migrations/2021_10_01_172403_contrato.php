<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('setor');
            $table->string('empresa');
            $table->string('fornecedor');
            $table->string('descricao_do_servico');
            $table->string('local');
            $table->string('status');
            $table->string('obs');
            $table->string('data_inicio');
            $table->date('data_fim');
            $table->date('data_assinatura');
            $table->string('valor_contrato');
            $table->string('dia_pagamento');
            $table->string('juros_multa_atraso');
            $table->string('multa_recisoria');
            $table->string('pdf_documento');
            $table->string('diretor_assinante');
            $table->string('diretor_autorizador');
            $table->string('prazo_vigencia');
            $table->string('forma_de_pagamento');
            $table->string('carencia');
            $table->string('nome_representante');
            $table->string('telefone_representante');
            $table->string('recisao_antecipada');
            $table->string('prazo_recisao');
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
