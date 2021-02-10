<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExposicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exposicao', function (Blueprint $table) {
            $table->char('exposicaoID', 6)->primary();

            $table->unsignedBigInteger('instituicaoID');
            $table->foreign('instituicaoID')
                ->references('instituicaoID')
                ->on('instituicao')
                ->onDelete('cascade');

            $table->string('nome', 100);
            $table->date('dataAbertura');
            $table->date('dataEncerramento')->nullable();
            $table->string('descricao', 1000)->nullable();
            $table->boolean('estado');
            $table->string('fotografia', 1000)->nullable();
            $table->string('localizacao', 200)->nullable();
            $table->boolean('gratuito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exposicao');
    }
}
