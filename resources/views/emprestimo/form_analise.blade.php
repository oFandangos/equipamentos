@include('emprestimo.replicado',['codpes'=>$emprestimo->codpes])

@section('javascripts_head')
  <script src="{{asset('/js/script.js')}}"></script>
@endsection('javascript_head')

<b>Motivo:</b>
<div>
{{$emprestimo->motivo}}
</div>
<br>

@include('emprestimo.partials.form')

@can('docente')
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
