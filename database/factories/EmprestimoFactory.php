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
        $usuarios = [$this->faker->graduacao, $this->faker->docente,$this->faker->servidor];

        $status_opcao = array_keys(Emprestimo::status());

        $status = $status_opcao[array_rand($status_opcao)];


        $codpes = NULL;
        $comentario = NULL;
        $codpes_autorizador_devolucao = NULL;
        $comentario_devolucao = NULL;
        $data_devolvido = '0000-00-00';

        switch ($status) {
            case "deferido":
                $codpes = $this->faker->docente;
                $comentario =$this->faker->sentence;
            break;

            case "indeferido":
                $codpes = $this->faker->docente;
                $comentario =$this->faker->sentence;
            break;

            case "solicitado_devolucao":
                $codpes = $this->faker->docente;
                $comentario =$this->faker->sentence;
                $data_devolvido = $this->faker->date;
            break;

            case "deferido_devolucao":
                $codpes = $this->faker->docente;
                $comentario =$this->faker->sentence;
                $codpes_autorizador_devolucao = $this->faker->docente;
                $comentario_devolucao =$this->faker->sentence;
                $data_devolvido = $this->faker->date;
            break;

            case "indeferido_devolucao":
                $codpes = $this->faker->docente;
                $comentario =$this->faker->sentence;

                $codpes_autorizador_devolucao = $this->faker->docente;
                $comentario_devolucao =$this->faker->sentence;
                $data_devolvido = $this->faker->date;
            break;

        }

        return [
            'codpes' => $usuarios[array_rand($usuarios)],
            'data_retirada' => $this->faker->date,
            'motivo' => $this->faker->sentence,
            'patrimonio' => $this->faker->bempatrimoniado_informatica,
            'status' => $status,
            'codpes_autorizador' => $codpes,
            'comentario' => $comentario,
            'data_devolvido' => $data_devolvido,
            'codpes_autorizador_devolucao' => $codpes_autorizador_devolucao,
            'comentario_devolucao' => $comentario_devolucao,
        ];
    }
}
