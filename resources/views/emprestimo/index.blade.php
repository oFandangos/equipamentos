@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Lista dos Empréstimos</div>
                    <div class="card-body">

                        <form method="GET" action="{{ url('/emprestimo') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        @inject('pessoa','Uspdev\Replicado\Pessoa')
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Socilitante</th>
                                        <th>Data Retirada</th>
                                        <th>Patrimonio
                                        </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($emprestimo as $item)
                                    <tr>
                                    
                                        <td>
                                            {{ $pessoa::nomeCompleto($item->codpes)['nompesttd'] }}
                                        </td>
                                        <td>{{ $item->data_retirada }}</td>
                                        <td>{{ $item->patrimonio }}</td>
                                        <td>
                                            <a href="{{ url('/emprestimo/' . $item->id) }}" title="View Emprestimo"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/emprestimo/' . $item->id . '/edit') }}" title="Edit Emprestimo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $emprestimo->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
