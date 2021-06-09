@extends('layouts.app')

@section('content')
    <div class="container">
    @include('flash')
        <div class="row">

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Lista dos Empréstimos</div>
                    <div class="card-body">

                    <form method='GET'>

                            <div class=" col-sm input-group">


                                                <!--
                        <div class="row">
                                <input type="text" class="form-control" name="busca" value="{{Request()->busca}}" placeholder="Busca por número de patrimônio">  
                        </div>
                        <br>
                        -->


                                <select name="buscastatus" class="form-control">
                                    <option value="" selected="">- Status do Emprestimo -</option>
                                    @foreach(App\Models\Emprestimo::status() as $key=>$value)

                                    <option value="{{$key}}" name="buscastatus" 
                                    @if($key == Request()->buscastatus) selected @endif
                                    >{{$value}}</option>

                                    @endforeach
                                </select>

                                <span class="input-group-btn">

                                    <button type="submit" class="btn btn-success"> Filtrar </button>

                                </span>
                            </div>    
                        </div>
                    </form>

                    {{ $emprestimo->appends(request()->query())->links() }}

                        @inject('pessoa','Uspdev\Replicado\Pessoa')
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Deferimento</th>
                                        <th>Status</th>
                                        <th>Comentário</th>
                                        <th>Solicitante</th>
                                        <th>Data Retirada</th>
                                        <th>Patrimônio</th>
                                        <th>Motivo</th>

                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($emprestimo as $item)
                                    <tr>
                                        <td><a href="/emprestimo/{{ $item->id }}/edit" class="btn btn-info btn-sm">Analisar</a></td>

                                        <td>{{ $item->Status()[$item->status] }} </td>
                                        <td>
                                        @if($item->status=='indeferido')
                                        {{$item->comentario}}
                                        @else
                                        Ainda não avaliado
                                        @endif
                                        </td>
                                        <td>
                                            {{ $pessoa::nomeCompleto($item->codpes) }}
                                        </td>
                                        <td>{{ $item->data_retirada }}</td>
                                        <td>{{ $item->patrimonio }}</td>
                                        <td>{{ $item->motivo }}</td>
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
