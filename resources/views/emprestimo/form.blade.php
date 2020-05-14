<div class="form-group {{ $errors->has('codpes') ? 'has-error' : ''}}">
    <label for="codpes" class="control-label">{{ 'Codpes' }}</label>
    <input class="form-control" name="codpes" type="text" id="codpes" value="{{ isset($emprestimo->codpes) ? $emprestimo->codpes : ''}}" >
    {!! $errors->first('codpes', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('data_retirada') ? 'has-error' : ''}}">
    <label for="data_retirada" class="control-label">{{ 'Data Retirada' }}</label>
    <input class="form-control" name="data_retirada" type="date" id="data_retirada" value="{{ isset($emprestimo->data_retirada) ? $emprestimo->data_retirada : ''}}" >
    {!! $errors->first('data_retirada', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('patrimonio') ? 'has-error' : ''}}">
    <label for="patrimonio" class="control-label">{{ 'Patrimonio' }}</label>
    <input class="form-control" name="patrimonio" type="text" id="patrimonio" value="{{ isset($emprestimo->patrimonio) ? $emprestimo->patrimonio : ''}}" >
    {!! $errors->first('patrimonio', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('autorizado') ? 'has-error' : ''}}">
    <label for="autorizado" class="control-label">{{ 'Autorizado' }}</label>
    <div class="radio">
    <label><input name="autorizado" type="radio" value="1" {{ (isset($emprestimo) && 1 == $emprestimo->autorizado) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="autorizado" type="radio" value="0" @if (isset($emprestimo)) {{ (0 == $emprestimo->autorizado) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
    {!! $errors->first('autorizado', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('codpes_autorizador') ? 'has-error' : ''}}">
    <label for="codpes_autorizador" class="control-label">{{ 'Codpes Autorizador' }}</label>
    <input class="form-control" name="codpes_autorizador" type="text" id="codpes_autorizador" value="{{ isset($emprestimo->codpes_autorizador) ? $emprestimo->codpes_autorizador : ''}}" >
    {!! $errors->first('codpes_autorizador', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
