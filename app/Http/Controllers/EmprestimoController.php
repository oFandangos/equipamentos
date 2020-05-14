<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Emprestimo;
use Illuminate\Http\Request;

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
        return view('emprestimo.create');
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
        
        $requestData = $request->all();
        
        Emprestimo::create($requestData);

        return redirect('emprestimo')->with('flash_message', 'Emprestimo added!');
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
