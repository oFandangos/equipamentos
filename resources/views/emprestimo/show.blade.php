@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Empréstimo {{ $emprestimo->patrimonio }}</div>
                    <div class="card-body">

                        @include('emprestimo.replicado',['codpes'=>$emprestimo->codpes])

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
                                        <th> Data Retirada </th>
                                        <td> {{ $emprestimo->data_retirada }} </td>
                                    </tr>
                                    <tr>
                                        <th> Patrimonio </th>
                                        <td> {{ $emprestimo->patrimonio }} </td>
                                    </tr>
                                    <tr>
                                        <th> Status</th>
                                        <td> {{ $emprestimo->status }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
