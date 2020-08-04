<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsDevolucao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emprestimos', function (Blueprint $table) {
            $table->date('data_devolvido')->nullable()->default('0000-00-00');
            $table->string('codpes_autorizador_devolucao')->nullable();
            $table->string('comentario_devolucao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emprestimos', function (Blueprint $table) {
            //
        });
    }
}
