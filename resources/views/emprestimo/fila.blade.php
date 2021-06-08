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

                        <div class="row">
                                <input type="text" class="form-control" name="busca" value="{{Request()->busca}}" placeholder="Busca por número de patrimônio">  
                        </div>
                        <br>
            
                        @foreach(App\Models\Emprestimo::status() as $key=>$value)
                            <div class="form-group form-check">
                                <input class="form-check-input" type="radio" name="buscastatus" value="{{$key}}" @if(Request()->buscastatus == $key) checked @endif>
                                <label class="form-check-label">
                                {{$value}}
                                </label>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <span class="input-group-btn">

                                <button type="submit" class="btn btn-success"> Filtrar </button>

                                <form method='GET' action='/fila'>
                                    <input class="btn btn-primary" type="submit" value="Limpar filtro" >
                                </form>

                            </span>
                        </div>
                    </form>

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
