@extends('interbits::template.master')
@section('content')
    <div class="container">
        <a href="{{url('interbits/usuarios/editar')}}" class="btn btn-default">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Novo Usuário</a>
        <br/><br/>
        <div class="panel panel-default">
            <div class="panel panel-heading">Filtro</div>
            <div class="panel-body">
                <form action="{{url('interbits/usuarios/filtrar')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="email">E-mail:</label>
                            <input type="text" name="email" class="form-control" id="email">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="celular">Celular:</label>
                            <input type="text" name="celular" class="form-control" id="celular">
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
            <div class="panel-heading">Usuários</div>
            <div class="panel-body">
                @if(count($usuarios) > 0){
                <table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Celular</th>
                        <th>Função</th>
                        <th>Cadastrado</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->nome}}</td>
                            <td>{{$usuario->email}}</td>
                            <td>({{$usuario->ddd}}){{$usuario->celular}}</td>
                            <td>{{$usuario->cargo->nome}}</td>
                            <td>{{$usuario->created_at}}</td>
                            <td>
                                <a href="{{url('interbits/usuarios/editar', ['id' => $usuario->id])}}"
                                   class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Alterar
                                </a>
                                <a href="{{url('interbits/usuarios/remover', ['id' => $usuario->id])}}"
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
                {{$usuarios->render()}}
            </div>
        </div>
    </div>
@endsection