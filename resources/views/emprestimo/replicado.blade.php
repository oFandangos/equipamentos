@inject('pessoa','Uspdev\Replicado\Pessoa')
@inject('replicado_utils','App\Utils\ReplicadoUtils')
<ul>
    <li><b>Número USP:</b> {{ $codpes }}</li>
    <li><b>Nome:</b> {{ $pessoa::nomeCompleto($codpes) }}</li>
    <li><b>Email:</b> {{ $pessoa::email($codpes) }}</li>
    <li><b>Endereço:</b> {{ $replicado_utils::enderecoCompleto($codpes) }}</li>
    <li><b>Telefones:</b>
    <ul>
        @foreach($pessoa::telefones($codpes) as $telefone)
        <li>{{ $telefone }}</li>
        @endforeach
    </ul>
    </li>
</ul>
