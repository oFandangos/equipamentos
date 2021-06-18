@extends('layouts.app')

@section('content')
@include('flash')
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
                                        <th>Comentário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($emprestimo as $item)
                                    <tr>
                                        @can('admin')
                                          <td>
                                            <a href="{{ url('/emprestimo/' . $item->id) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-see" aria-hidden="true"></i> Ver</button></a> 
                                            <a href="{{ url('/devolver_direto/' . $item->id) }}"><button class="btn btn-primary btn-sm" onClick="return confirm('Tem certeza que deseja concluir o deferimento?')"> Devolver Direto</button></a>
                                          </td>
                                        @endcan
                                        <td>
                                            {{ $pessoa::nomeCompleto($item->codpes) }}
                                        </td>
                                        <td>{{ $item->data_retirada }}</td>
                                        <td>{{ $item->patrimonio }}</td>
                                        <td>{{ $pessoa::nomeCompleto($item->codpes_autorizador) }}</td>
                                        <td>{{$item->comentario}}</td>
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
