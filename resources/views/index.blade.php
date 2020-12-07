@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

<div class="card">
  <div class="card-header"><b>Sistema de Empréstimos de Equipamentos FFLCH - COVID-19</b></div>
  <div class="card-body">
  @auth
    @include('emprestimo.replicado',['codpes'=>Auth::user()->codpes])
  </div>
</div>

<br>
  <div class="card">
      <div class="card-header"><b>Lista de equipamentos solicitados</b></div>
    <div class="card-body">
      @inject('pessoa','Uspdev\Replicado\Pessoa')
      <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Solicitante</th>
                                        <th>Data Retirada</th>
                                        <th>Data Devolvido</th>
                                        <th>Status</th>
                                        <th>Patrimônio</th>
                                        <th>Autorizado Por</th>
                                        <th>Comentário</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                  @foreach($emprestimos as $item)

                                      <tr>
                                          <td>
                                              {{ $pessoa::nomeCompleto($item->codpes) }}
                                          </td>
                                          <td>{{ $item->data_retirada }}</td>
                                          <td>@if($item->data_devolvido == NULL) Devolução ainda não solicitada
                                          @else {{$item->data_devolvido}}
                                          @endif
                                          </td>
                                          <td>@if($item->status=='solicitado_devolucao')
                                          solicitado para devolução
                                          @else
                                          {{$item->status}}
                                          @endif</td>
                                          <td>{{ $item->patrimonio }}</td>
                                          <td>
                                            @if($item->status=='solicitado')
                                            Ainda não avaliado
                                            @else
                                            {{ $pessoa::nomeCompleto($item->codpes_autorizador) }}
                                            @endif
                                          </td>
                                          <td>
                                            @if($item->status!='solicitado')
                                            {{$item->comentario}}
                                            @else
                                            Ainda não avaliado
                                            @endif
                                          </td>
                                          <td>
                                            @if($item->status=='deferido')
                                            <a href="{{ url('/emprestimo/' . $item->id . '/devolver') }}" title="Devolver Emprestimo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Devolver</button></a>
                                            @elseif($item->status=='solicitado_devolucao')
                                            Aguarde a nova análise
                                            @else
                                            Ainda não avaliado
                                            @endif
                                          </td>

                                      </tr>
                                @endforeach
                                </tbody>
                            </table>
            </div>
    </div>

  @else
    Ainda não logado(a)
  @endauth

</div>
    </div>


@endsection('content')
