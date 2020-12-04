<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Emprestimo extends Model
{
    use HasFactory;
    use WorkflowTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emprestimos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    public function getDataRetiradaAttribute($value) {
        /* No banco está YYYY-MM-DD, mas vamos retornar DD/MM/YYYY */
        return implode('/',array_reverse(explode('-',$value)));
    }

    public function setDataRetiradaAttribute($value) {
        /* Chega no formato DD/MM/YYYY e vamos salvar como YYYY-MM-DD */
       $this->attributes['data_retirada'] = implode('-',array_reverse(explode('/',$value)));
    }
    public function getDataDevolvidoAttribute($value) {
        /* No banco está YYYY-MM-DD, mas vamos retornar DD/MM/YYYY */
        return implode('/',array_reverse(explode('-',$value)));
    }
    public function setDataDevolvidoAttribute($value) {
        /* Chega no formato DD/MM/YYYY e vamos salvar como YYYY-MM-DD */
       $this->attributes['data_devolvido'] = implode('-',array_reverse(explode('/',$value)));
    }

    public static function status(){
        return [
            'solicitado'           => 'Solicitado',
            'deferido'             => 'Empréstimo Deferido',
            'indeferido'           => 'Empréstimo Indeferido',
            'solicitado_devolucao' => 'Solicitação de Devolução',
            'deferido_devolucao'   => 'Devolução Deferida',
            'indeferido_devolucao' => 'Devolucão Indeferida'
        ];
    }
}
