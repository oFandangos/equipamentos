@include('emprestimo.replicado',['codpes'=>Auth::user()->codpes])

@section('javascripts_head')
  <script src="{{asset('/js/script.js')}}"></script>
@endsection('javascript_head')


@include('emprestimo.partials.form')

<div class="form-group">
    <label for="motivo" class="control-label"><b> Motivo: </b></label>
    <textarea class="form-control" name="motivo">{{ old('motivo',$emprestimo->motivo)}}</textarea>
</div>

<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="termo" name="termo" value="termo">
    <label class="form-check-label" for="termo">
    <i>Pelo presente assumo a responsabilidade civil e criminal da utilização dos bens emprestados.
    Estou ciente que a Faculdade de Filosofia, Letras e Ciências Humanas da Universidade de
São Paulo, poderá, a seu critério, revogar a presente permissão a qualquer momento, e que devolverei os
materiais emprestados .</i>
    </label>
  </div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Enviar">
</div>
