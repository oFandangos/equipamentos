<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Emprestimo;
use Illuminate\Http\Request;
use Auth;
use Workflow;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $emprestimo = Emprestimo::where('codpes', 'LIKE', "%$keyword%")
                ->orWhere('data_retirada', 'LIKE', "%$keyword%")
                ->orWhere('patrimonio', 'LIKE', "%$keyword%")
                ->orWhere('autorizado', 'LIKE', "%$keyword%")
                ->orWhere('codpes_autorizador', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $emprestimo = Emprestimo::latest()->paginate($perPage);
        }

        return view('emprestimo.index', compact('emprestimo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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
        $request->validate([
            'motivo' => 'required',
            'termo' => 'required',
            'patrimonio' => 'required|patrimonio',
            'data_retirada' => 'required|data'
        ]);
        
        $emprestimo = new Emprestimo;
        $emprestimo->motivo = $request->motivo;
        $emprestimo->patrimonio = $request->patrimonio;
        $emprestimo->data_retirada = $request->data_retirada;
        $emprestimo->codpes = Auth::user()->codpes;
        $emprestimo->save();

        $workflow = $emprestimo->workflow_get();
        dd($emprestimo->getCurrentPlace());
        /*
        $workflow = $emprestimo->workflow_get();
        $workflow->apply($emprestimo, 'solicitado');
        $workflow = Workflow::get($emprestimo);
        */

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
    public function show($id)
    {
        $emprestimo = Emprestimo::findOrFail($id);

        return view('emprestimo.show', compact('emprestimo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $emprestimo = Emprestimo::findOrFail($id);

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
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $emprestimo = Emprestimo::findOrFail($id);
        $emprestimo->update($requestData);

        return redirect('emprestimo')->with('flash_message', 'Emprestimo updated!');
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
        Emprestimo::destroy($id);

        return redirect('emprestimo')->with('flash_message', 'Emprestimo deleted!');
    }
}
