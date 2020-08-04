<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Emprestimo;
use Faker\Generator as Faker;

$factory->define(Emprestimo::class, function (Faker $faker) {

	$usuarios = [$faker->graduacao, $faker->docente,$faker->servidor];

	$status_opcao = array_keys(Emprestimo::status());

	$status = $status_opcao[array_rand($status_opcao)];
	
	
	$codpes = NULL;
	$comentario = NULL;
	$codpes_autorizador_devolucao = NULL;
	$comentario_devolucao = NULL;
	$data_devolvido = '0000-00-00';
	
	switch ($status) {
		case "deferido":
			$codpes = $faker->docente;
			$comentario =$faker->sentence;
		break;

		case "indeferido":
			$codpes = $faker->docente;
			$comentario =$faker->sentence;
		break;

		case "solicitado_devolucao":
			$codpes = $faker->docente;
			$comentario =$faker->sentence;
			$data_devolvido = $faker->date;
		break;

		case "deferido_devolucao":
			$codpes = $faker->docente;
			$comentario =$faker->sentence;
			$codpes_autorizador_devolucao = $faker->docente;
			$comentario_devolucao =$faker->sentence;
			$data_devolvido = $faker->date;
		break;

		case "indeferido_devolucao":
			$codpes = $faker->docente;
			$comentario =$faker->sentence;
			
			$codpes_autorizador_devolucao = $faker->docente;
			$comentario_devolucao =$faker->sentence;
			$data_devolvido = $faker->date;
		break;

	}

    return [
	    'codpes' => $usuarios[array_rand($usuarios)],
	    'data_retirada' => $faker->date,
	    'motivo' => $faker->sentence,
	    'patrimonio' => $faker->bempatrimoniado_informatica,
	    'status' => $status,
		'codpes_autorizador' => $codpes,
		'comentario' => $comentario,
		'data_devolvido' => $data_devolvido,
		'codpes_autorizador_devolucao' => $codpes_autorizador_devolucao,
		'comentario_devolucao' => $comentario_devolucao,   
        ];
   
});
