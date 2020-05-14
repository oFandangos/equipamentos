<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
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

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['codpes', 'data_retirada', 'patrimonio', 'autorizado', 'codpes_autorizador'];

    
}
