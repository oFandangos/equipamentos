@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Emprestimo {{ $emprestimo->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/emprestimo') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/emprestimo/' . $emprestimo->id . '/edit') }}" title="Edit Emprestimo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('emprestimo' . '/' . $emprestimo->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Emprestimo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $emprestimo->id }}</td>
                                    </tr>
                                    <tr><th> Codpes </th><td> {{ $emprestimo->codpes }} </td></tr><tr><th> Data Retirada </th><td> {{ $emprestimo->data_retirada }} </td></tr><tr><th> Patrimonio </th><td> {{ $emprestimo->patrimonio }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
