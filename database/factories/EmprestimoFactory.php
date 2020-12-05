<?php

namespace Database\Factories;

use App\Models\Emprestimo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmprestimoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emprestimo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
    }
}
