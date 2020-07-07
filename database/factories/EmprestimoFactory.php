<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Emprestimo;
use Faker\Generator as Faker;

$factory->define(Emprestimo::class, function (Faker $faker) {

	$usuarios = [$faker->graduacao, $faker->docente,$faker->servidor];
    $status_opcao = ['solicitado', 'deferido', 'indeferido'];

    $status = $status_opcao[array_rand($status_opcao)];

	if($status != "solicitado"){
		$codpes = $faker->docente;
		$comentario =$faker->sentence;
	} else {
		$codpes = NULL;
		$comentario = NULL;
	};

    return [
	    'codpes' => $usuarios[array_rand($usuarios)],
	    'data_retirada' => $faker->date,
	    'motivo' => $faker->sentence,
	    'patrimonio' => $faker->bempatrimoniado_informatica,
	    'status' => $status,
		'codpes_autorizador' => $codpes,
		'comentario' => $comentario,	    
        ];
   
});
