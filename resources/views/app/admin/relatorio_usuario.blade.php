@extends('layouts.admin')

@section('titulo', 'GSE')

@section('content')

<style>
    .ativado { background-color: rgb(176, 222, 248); text-align: left; color: rgb(5, 0, 0)}
    .desativado { background-color: #fd8b83; text-align: left; color: rgb(14, 13, 13)}
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-uppercase">Usuarios</h1>
    {{--<a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#convenioModal">
        <i class="fas fa-download fa-sm text-white-50"></i> Novo Convenio
    </a>--}}
</div>

{{--
<!-- Pending Requests Card Example -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Questões</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-success btn-sm">
                    {{$respostas->count()}}
                </div>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-comments fa-2x text-gray-300"></i>-->
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Acertos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-primary btn-sm">
                    {{$respostas_certas}}
                </div>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-comments fa-2x text-gray-300"></i>-->
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Erros</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-danger btn-sm">
                    {{$respostas_erradas}}
                </div>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-comments fa-2x text-gray-300"></i>-->
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">%</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-primary btn-sm">
                    {{$porcetagem_certas}}%
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-danger btn-sm">
                    {{$porcetagem_erradas}}%
                </div>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-comments fa-2x text-gray-300"></i>-->
            </div>
            </div>
        </div>
        </div>
    </div>
</div>--}}

<div class="card shadow mb-4"><div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">USUARIOS</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table_alunos" class="table" style="width:100%">    
            <thead>
                <tr>
                    <th>USUARIOS</th>
                    <th>LOGIN</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>               
                @if (count($users)>0)
                    @foreach ($users as $user)
                       @if($user->ativo == 1)
                          @php $classe = 'ativado' @endphp   
                       @else
                          @php $classe = 'desativado' @endphp 
                       @endif
                        <tr class="{{$classe}}">
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->ativo == 1)
                                    <a href="#" data-toggle="modal" data-target="#ativar_desativar_usuario" href="javascript:void(0);" data-iduser="{{$user->id}}" data-ativardesativar="1" alt="Desativar Usuario" title="Desativar Usuario">
                                       <i class="fas fa-clipboard-list"></i>
                                    </a>
                                    <a href="#" class="" data-toggle="modal" data-target="#alterar_senha_usuario" href="javascript:void(0);" data-iduser="{{$user->id}}" alt="Alterar Senha" title="Alterar Senha">
                                        <i class="fas fa-unlock"></i>
                                    </a>
                                @else    
                                    <a href="#" class="" data-toggle="modal" data-target="#ativar_desativar_usuario" href="javascript:void(0);" data-iduser="{{$user->id}}" data-ativardesativar="0" alt="Ativar Usuario" title="Ativar Usuario">
                                        <i class="fas fa-file-import"></i>
                                    </a>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-danger">
                                <i class="glyphicon glyphicon-remove"></i>
                                <div class="mensagem">
                                    Nenhum Usuario foi encontrado.
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col col-sm">
            Exibindo <b>{{count($users)}}</b> de <b>{{$users->total()}}</b> {{($users->total()>1?'pesquisas':'pesquisa')}}.
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="row justify-content-md-center">
            <div align="center">
                {{$users->fragment('usuario')->render()}}
            </div>
        </div>
    </div>
    
</div>



@stop
