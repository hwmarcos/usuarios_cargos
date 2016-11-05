@extends('interbits::template.master')
@section('content')
    <div class="container">
        <a href="{{url('interbits/funcoes/editar')}}" class="btn btn-default">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Nova Função
        </a>
        <br/><br/>
        <div class="panel panel-default">
            <div class="panel panel-heading">Filtro</div>
            <div class="panel-body">
                <form action="{{url('interbits/funcoes/filtrar')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-9 form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" name="nome">
                        </div>
                        <div class="col-md-3 form-group" style="margin-top:25px;">
                            <button type="submit" class="btn btn-block btn-default">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Funções</div>
            <div class="panel-body">
                @if(count($cargos) > 0){
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cadastrado</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cargos as $cargo)
                        <tr>
                            <td>{{$cargo->nome}}</td>
                            <td>{{$cargo->created_at}}</td>
                            <td>
                                <a href="{{url('interbits/funcoes/editar', ['id' => $cargo->id])}}"
                                   class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Alterar
                                </a>
                                <a href="{{url('interbits/funcoes/remover', ['id' => $cargo->id])}}"
                                   class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    Remover
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <div class="alert alert-danger">Nenhum registro encontrado.</div>
                @endif
                {{$cargos->render()}}
            </div>
        </div>
    </div>
@endsection