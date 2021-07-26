@extends('layouts.admin')

@section('titulo', 'GSE')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-uppercase">Clínicas</h1>
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
    <h6 class="m-0 font-weight-bold text-primary">Clínicas</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <!--<table id="table_admin" class="display" style="width:100%">-->
        <table id="table_alunos" class="table" style="width:100%">    
            <thead>
                <tr>
                    <th>CLINICA</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>               
                @if (count($clinicas)>0)
                    @foreach ($clinicas as $clinica)
                        <tr>
                            <td>{{$clinica->nome_clinica}}</td>
                            <td>
                                @if($clinica->ativo == 1)
                                    <a href="#" class="adicionar_pendecia" data-toggle="modal" data-target="#ativar_clinica" href="javascript:void(0);" data-idclinica="{{$clinica->id_clinica}}" alt="Desativar Clinica" title="Desativar Clinica">
                                        <i class="fas fa-clipboard-list"></i>
                                    </a>
                                @else    
                                    <a href="#" class="lista_upload" data-toggle="modal" data-target="#desativar_clinica" href="javascript:void(0);" data-idclinica="{{$clinica->id_clinica}}" alt="Ativar Clinica" title="Ativar Clinica">
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
                                    Nenhum Clinica foi encontrado.
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
            Exibindo <b>{{count($clinicas)}}</b> de <b>{{$clinicas->total()}}</b> {{($clinicas->total()>1?'pesquisas':'pesquisa')}}.
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="row justify-content-md-center">
            <div align="center">
                {{$clinicas->fragment('clinica')->render()}}
            </div>
        </div>
    </div>
    
</div>



@stop
