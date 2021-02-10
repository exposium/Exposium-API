<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao', function (Blueprint $table) {
            $table->id('instituicaoID');

            $table->string('nome', 200);
            $table->string('morada', 200);
            $table->char('telefone', 9);
            $table->string('email', 100);
            $table->string('password', 500);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicao');
    }
}
