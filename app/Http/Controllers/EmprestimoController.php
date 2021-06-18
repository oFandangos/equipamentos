<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use Auth;
use Workflow;
use Carbon\Carbon;
use App\Utils\ReplicadoUtils;
use Maatwebsite\Excel\Excel;
use App\Exports\ExcelExport;

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
        $emprestimo = Emprestimo::where('status', 'deferido')->paginate(10);
        return view('emprestimo.index', compact('emprestimo'));
    }

    public function fila(Request $request, Excel $excel)
    {
        $this->authorize('docente');

        if($request->fila_action == 'filtro') {
            if (isset($request->busca)) {
                $emprestimo = Emprestimo::where('patrimonio','LIKE',"{$request->busca}")->paginate(10);
    
            } else if(isset($request->buscastatus)) {
                if ($request->buscastatus != null){
                $emprestimo = Emprestimo::where('status','=',"{$request->buscastatus}")->paginate(10);
                }
                
            }else{
                $emprestimo = Emprestimo::paginate(10);
            }

            return view('emprestimo.fila', compact('emprestimo'));
        }

        if($request->fila_action == 'gerarplanilha') {
            $headings = ['Patrimônio','Status','Solicitante','Comentário','Data de Retirada','Motivo','Data de Devolução','Comentário sobre a Devolução'];
            $campos = ['patrimonio','status','codpes','comentario','data_retirada','motivo','data_devolvido','comentario_devolucao'];


            if (isset($request->buscastatus)) {
                $data = Emprestimo::get($campos)->where('status','=',"{$request->buscastatus}")->toArray();
            }else{
                $data = Emprestimo::get($campos)->toArray();
            }

            $export = new ExcelExport($data,$headings);
            return $excel->download($export, 'emprestimos.xlsx');
        }

        $emprestimo = Emprestimo::paginate(10);

        return view('emprestimo.fila', compact('emprestimo'));
    }

    public function devolver_form(Emprestimo $emprestimo)
    {
        if (Auth::guest()) return redirect('/login');
        $this->authorize('logado');

       return view('emprestimo.devolver', compact('emprestimo'));
    }

    public function devolver(Request $request, Emprestimo $emprestimo)
    {
        $request->validate([
            'data_devolvido' => 'data'
        ]);
        $this->authorize('logado');

        $emprestimo->data_devolvido = $request->data_devolvido;

        $emprestimo->status = 'solicitado_devolucao';
        $emprestimo->update();
        return redirect('/');
    }


    public function devolver_direto(Request $request, Emprestimo $emprestimo)
    {
        $this->authorize('logado');
        $emprestimo->data_devolvido = Carbon::now();
        $emprestimo->status = 'deferido_devolucao';
        $emprestimo->update();
        return redirect('/fila');
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
            'patrimonio' => 'required', # multiple_patrimonio
            'data_retirada' => 'required|data'
        ]);

        $emprestimo->patrimonio = $request->patrimonio;
        $emprestimo->data_retirada = $request->data_retirada;
        $emprestimo->codpes_autorizador = Auth::user()->codpes;
        $emprestimo->comentario = $request->comentario;

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
