<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            /* Preenchidos por quem solicita */
            $table->string('codpes');
            $table->date('data_retirada');
            $table->text('motivo');
            $table->string('patrimonio');
            $table->string('status');

            /* Preenchidos por quem autoriza */
            $table->string('codpes_autorizador')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emprestimos');
    }
}
