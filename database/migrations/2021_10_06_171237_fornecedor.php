<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cnpj')->unique();
            $table->string('email', 64)->unique();
            $table->string('email_secundario', 64)->unique()->nullable();
            $table->string('tipo_pessoa');
            $table->string('telefone');
            $table->string('inscricao_estadual');
            $table->string('ramo_atuacao');
            $table->string('ponto_contato');
            $table->string('cargo_funcao');
            $table->timestamp('data_fim')->nullable();
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
