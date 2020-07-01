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
                                        <th>Status</th>
                                        <th>Patrimônio</th>
                                        <th>Autorizado Por</th>
                                        <th>Comentário</th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($emprestimos as $item)

	                                    <tr>
	                                        <td>
	                                            {{ $pessoa::nomeCompleto($item->codpes)['nompesttd'] }}
	                                        </td>
	                                        <td>{{ $item->data_retirada }}</td>
                                          <td>{{$item->status}}
	                                        <td>{{ $item->patrimonio }}</td>
                                          <td>
                                            @if($item->status=='deferido')
	                                          {{ $pessoa::nomeCompleto($item->codpes_autorizador)['nompesttd'] }}
                                            @else
                                            Ainda não avaliado
                                            @endif
                                          </td>
                                          <td>
                                            @if($item->status=='deferido')
	                                          {{$item->comentario}}
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
