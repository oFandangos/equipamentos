<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uspdev\Replicado\Pessoa;
use Auth;
use App\Models\Emprestimo;

class IndexController extends Controller
{
    public function index(){
        if(Auth::user()) {
            $emprestimos =  Emprestimo::where('codpes',Auth::user()->codpes)->paginate(10);
        } else {
            $emprestimos = [];
        }
        return view('index')->with('emprestimos',$emprestimos);
    }

}
