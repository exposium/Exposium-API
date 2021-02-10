<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->id('itemID');

            $table->char('exposicaoID', 6);
            $table->foreign('exposicaoID')
                ->references('exposicaoID')
                ->on('exposicao')
                ->onDelete('cascade');

            $table->unsignedTinyInteger('tipoItemID');
            $table->foreign('tipoItemID')
                ->references('tipoItemID')
                ->on('tipoDeItem')
                ->onDelete('cascade');

            $table->string('nome', 60);
            $table->string('nomeAutor', 100)->nullable();
            $table->date('dataCriacao')->nullable();
            $table->string('fotografia', 1000)->nullable();
            $table->string('audio', 1000)->nullable();
            $table->string('video', 1000)->nullable();
            $table->string('descricao', 500)->nullable();
            $table->smallInteger('codigo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item');
    }
}
