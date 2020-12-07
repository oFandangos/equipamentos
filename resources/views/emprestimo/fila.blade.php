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

                        @foreach(App\Models\Emprestimo::status() as $key=>$value)
                            <div class="form-group form-check">
                                <input class="form-check-input" type="radio" name="busca" value="{{$key}}" @if(Request()->busca == $key) checked @endif>
                                <label class="form-check-label">
                                {{$value}}
                                </label>
                            </div>
                        @endforeach

                        <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Filtrar">
                        <br>
                        <br>
                        </form>

                        <form method='GET' action='/fila'>
                            <input class="btn btn-primary" type="submit" value="Limpar filtro" >
                        </form>
                        </div>

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

                                        <td>{{ $item->status }}</td>
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
