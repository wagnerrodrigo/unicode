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
            $table->string('nome_generico');
            $table->string('tipo');
            $table->string('forma_produto');
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
