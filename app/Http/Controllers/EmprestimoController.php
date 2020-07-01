<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Emprestimo;
use Illuminate\Http\Request;
use Auth;
use Workflow;
use App\Utils\ReplicadoUtils;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('docente');
        $emprestimo = Emprestimo::where('status', 'deferido')->get();
        return view('emprestimo.index', compact('emprestimo'));
    }

    public function fila(Request $request)
    {
        $this->authorize('docente');
        $emprestimo = Emprestimo::where('status','!=' , 'deferido')->get();
        return view('emprestimo.fila', compact('emprestimo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Auth::guest()) return redirect('/login');
        $this->authorize('logado');
        return view('emprestimo.create')->with('emprestimo',new Emprestimo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('logado');
        $request->validate([
            'motivo' => 'required',
            'termo' => 'required',
            'patrimonio' => 'multiple_patrimonio',
            'data_retirada' => 'data'
        ]);

        if(is_null($request->patrimonio)){
            $patrimonio = ' ';
        } else {
            $patrimonio = $request->patrimonio;
        }

        $emprestimo = new Emprestimo;
        $emprestimo->motivo = $request->motivo;
        $emprestimo->patrimonio = $patrimonio;
        $emprestimo->data_retirada = $request->data_retirada;
        $emprestimo->codpes = Auth::user()->codpes;
        $emprestimo->status = 'solicitado';
        $emprestimo->save();

        $request->session()->flash('alert-info','Solicitação enviada para Análise: ');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Emprestimo $emprestimo)
    {
        $this->authorize('docente');
        return view('emprestimo.show', compact('emprestimo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Emprestimo $emprestimo)
    {
        $this->authorize('docente');
        return view('emprestimo.edit', compact('emprestimo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        $this->authorize('docente');
        $request->validate([
            'analise' => 'required',
            'patrimonio' => 'required|multiple_patrimonio',
            'data_retirada' => 'required|data'
        ]);

        $emprestimo->patrimonio = $request->patrimonio;
        $emprestimo->data_retirada = $request->data_retirada;
        $emprestimo->codpes_autorizador = Auth::user()->codpes;
        $emprestimo->comentario = $request->comentario;

        /*
        $workflow = $emprestimo->workflow_get();
        if($request->analise == 'indeferido'){
            $workflow->apply($emprestimo, 'indeferir');
            $request->session()->flash('alert-info','Indeferido');
        } else {
            $workflow->apply($emprestimo, 'deferir');
            $request->session()->flash('alert-info','Deferido');
        }
         */

        $emprestimo->status = $request->analise;
        $emprestimo->save();

        return redirect("emprestimo/{$emprestimo->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $this->authorize('admin');
        Emprestimo::destroy($id);

        return redirect('emprestimo')->with('flash_message', 'Emprestimo deleted!');
    }
}
