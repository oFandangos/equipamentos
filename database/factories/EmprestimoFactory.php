<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Emprestimo;
use Faker\Generator as Faker;

$factory->define(Emprestimo::class, function (Faker $faker) {

	$usuarios = [$faker->graduacao, $faker->docente,$faker->servidor];
    $status_opcao = ['Solicitado', 'Deferido', 'Indeferido'];

    $status = $status_opcao[array_rand($status_opcao)];

	    if($status != "Solicitado"){

	    	$codpes = $faker->servidor;
	    }else{
	    	$codpes = NULL;
	    };

    return [
	    'codpes' => $usuarios[array_rand($usuarios)],
	    'data_retirada' => $faker->date,
	    'motivo' => $faker->sentence,
	    'patrimonio' => $faker->bempatrimoniado,
	    'status' => $status,
	    'codpes_autorizador' => $codpes,	    
        ];
   
});
