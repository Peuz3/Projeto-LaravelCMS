@extends('adminlte::page')

@section('title','Usuário')
    
@section('content_header')

    <h1>
        Meus Usuários
        <a href="{{route('users.create')}}" class="btn btn-sm btn-success">Novo Usuário</a>
    </h1>
    
@endsection

@section('content')

<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Ações</th>
    </tr>
    
    @foreach ($users as $user)
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>
            <a href="{{route('users.edit',['user'=>$user->id])}}" class="btn btn-sm btn-info">Editar</a>
            <a href="{{route('users.destroy',['user'=>$user->id])}}" class="btn btn-sm btn-danger">Excluir</a>
        </td>  
    
    @endforeach
    
</table>   
    
@endsection