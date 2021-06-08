@include('emprestimo.replicado',['codpes'=>$emprestimo->codpes])

@section('javascripts_head')
  <script src="{{asset('/js/script.js')}}"></script>
@endsection('javascript_head')

<div>
<b>Motivo do pedido:</b> {{$emprestimo->motivo}}<br>
<b>Status do emprestimo:</b> {{ $emprestimo->Status()[$emprestimo->status] }}
</div>
<br>

@include('emprestimo.partials.form')

@can('docente')

  @if($emprestimo->status!='deferido_devolucao')
    @if($emprestimo->status=='solicitado_devolucao')
      <div class="form-group form-check">
          <input class="form-check-input" type="radio" name="analise" id="" value="deferido_devolucao">
        <label class="form-check-label" for="analise_deferido">
          Deferir Devolução
        </label>
      </div>

      <div class="form-group form-check">
        <input class="form-check-input" type="radio" name="analise" id="" value="indeferido_devolucao" @if($emprestimo->status=='indeferido_devolucao') checked @endif>
        <label class="form-check-label" for="analise_indeferido">
          Indeferir Devolução
        </label>
      </div>
    @else
      <div class="form-group form-check">
          <input class="form-check-input" type="radio" name="analise" id="" value="deferido" @if($emprestimo->status=='deferido') checked @endif>
        <label class="form-check-label" for="analise_deferido">
          Deferir
        </label>
      </div>

      <div class="form-group form-check">
        <input class="form-check-input" type="radio" name="analise" id="" value="indeferido" @if($emprestimo->status=='indeferido') checked @endif>
        <label class="form-check-label" for="analise_indeferido">
          Indeferir
        </label>
      </div>
    @endif
  @endif

<div class="form-group">
    <label for="comentario" class="control-label"><b> Comentário: </b></label>
    <textarea class="form-control" name="comentario">{{ old('comentario',$emprestimo->comentario)}}</textarea>
</div>
@endcan('docente')

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Enviar">
</div>

</form>

@can('admin')
<form method="POST" action="{{ url('emprestimo' . '/' . $emprestimo->id) }}" accept-charset="UTF-8" style="display:inline">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger btn-sm" title="Delete Emprestimo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
</form>
@endcan
