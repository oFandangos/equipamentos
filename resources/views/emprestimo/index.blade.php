@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Lista dos Empréstimos</div>
                    <div class="card-body">

                   
                        @inject('pessoa','Uspdev\Replicado\Pessoa')
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        @can('admin')<th>Ver</th> @endcan
                                        <th>Solicitante</th>
                                        <th>Data Retirada</th>
                                        <th>Patrimônio</th>
                                        <th>Autorizado Por</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($emprestimo as $item)
                                    <tr>
                                        @can('admin')
                                          <td>
                                            <a href="{{ url('/emprestimo/' . $item->id) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-see" aria-hidden="true"></i> Ver</button></a>
                                          </td>
                                        @endcan
                                        <td>
                                            {{ $pessoa::nomeCompleto($item->codpes)['nompesttd'] }}
                                        </td>
                                        <td>{{ $item->data_retirada }}</td>
                                        <td>{{ $item->patrimonio }}</td>
                                        <td>{{ $pessoa::nomeCompleto($item->codpes_autorizador)['nompesttd'] }}</td>
         
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
