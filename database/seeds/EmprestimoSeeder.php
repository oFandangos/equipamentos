<?php

use Illuminate\Database\Seeder;

class EmprestimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entrada = [
            'codpes' => '10703080',
            'data_retirada' => '2020-06-28',
            'motivo' => 'Home Office',
            'patrimonio' => '008.00145', 
            'status' => 'Solicitado',
        ];
        App\Emprestimo::create($entrada);

        factory(App\Emprestimo::class, 10)->create();
    }
}
