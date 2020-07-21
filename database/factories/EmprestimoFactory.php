<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Emprestimo;
use Faker\Generator as Faker;

$factory->define(Emprestimo::class, function (Faker $faker) {

	$usuarios = [$faker->graduacao, $faker->docente,$faker->servidor];
    $status_opcao = ['solicitado', 'deferido', 'indeferido', 'solicitado_devolucao', 'deferido_devolucao', 'indeferido_devolucao'];

    $status = $status_opcao[array_rand($status_opcao)];

	if($status == "solicitado"){
		$codpes = NULL;
		$comentario = NULL;
		
		$codpes2 = NULL;
		$comentario2 = NULL;
		
	}else if($status == "deferido"){
		$codpes = $faker->docente;
		$comentario =$faker->sentence;
		
		$codpes2 = NULL;
		$comentario2 = NULL;
		
	} else if($status == "indeferido"){
		$codpes = $faker->docente;
		$comentario =$faker->sentence;
		
		$codpes2 = NULL;
		$comentario2 = NULL;
		
	}else if($status == "solicitado_devolucao"){
		$codpes = $faker->docente;
		$comentario =$faker->sentence;
		
		$codpes2 = NULL;
		$comentario2 = NULL;
		
	}else if($status == "deferido_devolucao"){
	    $codpes = $faker->docente;
		$comentario =$faker->sentence;
		
		$codpes2 = $faker->docente;
		$comentario2 =$faker->sentence;
		
	}else if($status == "indeferido_devolucao"){
	    $codpes = $faker->docente;
		$comentario =$faker->sentence;
		
		$codpes2 = $faker->docente;
		$comentario2 =$faker->sentence;
		
	};
	

    return [
	    'codpes' => $usuarios[array_rand($usuarios)],
	    'data_retirada' => $faker->date,
	    'motivo' => $faker->sentence,
	    'patrimonio' => $faker->bempatrimoniado_informatica,
	    'status' => $status,
		'codpes_autorizador' => $codpes,
		'comentario' => $comentario,
		'data_devolvido' => $faker->date,
		'codpes_autorizador2' => $codpes2,
		'comentario2' => $comentario2,   
        ];
   
});
