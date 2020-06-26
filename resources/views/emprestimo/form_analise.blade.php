@include('emprestimo.replicado',['codpes'=>$emprestimo->codpes])

@section('javascripts_head')
  <script src="{{asset('/js/script.js')}}"></script>
@endsection('javascript_head')

<b>Motivo:</b>
<div>
{{$emprestimo->motivo}}
</div>
<br>
<div class="form-group}}">
    <label for="data_retirada" class="control-label"><b>Data que foi ou vai ser retirado o Equipamento:</b></label>
    <input autocomplete="off" class="form-control datepicker" name="data_retirada" type="text" id="data_retirada" value="{{ old('data_retirada',$emprestimo->data_retirada) }}" >
</div>

<div class="form-group">
    <label for="patrimonio" class="control-label"><b> Número de Patrimônio do Equipamento: </b></label>
    <input class="form-control patrimonio" name="patrimonio" type="text" id="patrimonio" value="{{ old('patrimonio',$emprestimo->patrimonio)}}" >
    <small>Exemplo: 008.034111</small>
</div>

@can('docente')
<div class="form-group form-check">
    <input class="form-check-input" type="radio" name="analise" id="" value="deferido" @if($emprestimo->analise=='deferido') checked @endif>
  <label class="form-check-label" for="analise_deferido">
    Deferir
  </label>
</div>

<div class="form-group form-check">
  <input class="form-check-input" type="radio" name="analise" id="" value="indeferido" @if($emprestimo->analise=='indeferido') checked @endif>
  <label class="form-check-label" for="analise_indeferido">
    Indeferir
  </label>
</div>
@endcan('docente')

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Enviar">
</div>

@can('admin')
<form method="POST" action="{{ url('emprestimo' . '/' . $emprestimo->id) }}" accept-charset="UTF-8" style="display:inline">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger btn-sm" title="Delete Emprestimo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
</form>
@endcan
