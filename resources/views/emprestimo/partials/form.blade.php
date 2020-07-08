<div class="form-group}}">
    <label for="data_retirada" class="control-label"><b>Data que foi ou vai ser retirado o Equipamento (pode ser aproximada):</b></label>
    <input autocomplete="off" class="form-control datepicker" name="data_retirada" type="text" id="data_retirada" value="{{ old('data_retirada',$emprestimo->data_retirada) }}" >
</div>

<div class="form-group">
    <label for="patrimonio" class="control-label"><b> Números de Patrimônio dos Equipamentos (se souber): </b></label>
    <input class="form-control patrimonio" name="patrimonio" type="text" id="patrimonio" value="{{ old('patrimonio',$emprestimo->patrimonio)}}" >
    <small>Exemplo: 008.034111, 008.037662</small>
</div>