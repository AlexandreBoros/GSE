@extends('layouts.admin')

@section('titulo', 'GSE')

@section('content')


<style>
    .analise { background-color: rgb(253, 250, 239); text-align: left; color: rgb(5, 0, 0)}
    .pendente { background-color: #ff1d0d; text-align: left; color: white}
    .pago { background-color: #1cf082; text-align: left; color: white}
    .baixado { background-color: #f5ef3d; text-align: left; color: rgb(110, 54, 230)}
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-uppercase">{{Auth::user()->name}}</h1>
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#convenioModal">
        <i class="fas fa-download fa-sm text-white-50"></i> Novo Processo
    </a>
</div>


<!-- Pending Requests Card Example -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Analise</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-secondary btn-sm">
                    {{$procesos_analise->count()}}
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
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendentes</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-danger btn-sm">
                    {{$procesos_pedente->count()}}
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
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Baixados</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-warning btn-sm">
                    {{$procesos_baixado->count()}}
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
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pagos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-100 btn btn-success btn-sm">
                    {{$procesos_pago->count()}}
                </div>
            </div>
            <div class="col-auto">
                <!--<i class="fas fa-comments fa-2x text-gray-300"></i>-->
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4"><div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Processos</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <!--<table id="table_admin" class="display" style="width:100%">-->
        <table id="table_alunos" class="table" style="width:100%">    
            <thead>
                <tr>
                    <th>CLINICA</th>
                    <th>NOME</th>
                    <th>CONVENIO</th>
                    {{--<th>PLANO</th>--}}
                    <th>SITUAÇÃO</th>
                    {{--<th>Nº CARTEIRINHA</th>--}}
                    <th>CPF</th>
                    <th>SENHA</th>
                    <th>DATA</th>
                    <th>PROTOCOLO</th>
                    <th>VALOR NF</th>
                    <th>VALOR PAGO</th>
                    <th>DATA PAGAMENTO</th>
                    {{--<th>% GSE</th>--}}
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>               
                @if (count($convenios)>0)
                    <?php $classe = "" ?>
                    @foreach ($convenios as $convenio)
                        @if($convenio->status_situacao == 1)
                            <?php $classe = 'analise' ?>
                        @elseif($convenio->status_situacao == 2)
                            <?php $classe = 'pendente' ?>   
                        @elseif($convenio->status_situacao == 3)
                            <?php $classe = 'baixado' ?>     
                        @elseif($convenio->status_situacao == 4)
                            <?php $classe = 'pago' ?>                                    
                        @endif 
                        <tr class="{{$classe}}">  
                            <td>{{$convenio->nome_clinica}}</td>
                            <td>{{$convenio->nome_paciente}}</td>
                            <td>{{$convenio->tipo_convenio}}</td>
                            {{--<td>{{$convenio->tipo_plano}}</td>--}}
                            <td class="text-uppercase">{{$convenio->nome_processo_status}}</td>
                            {{--<td class="text-uppercase">{{$convenio->numero_carterinha}}</td>--}}
                            <td class="text-uppercase">{{$convenio->cpf}}</td>
                            <td class="text-uppercase">{{$convenio->senha}}</td>
                            <td class="text-uppercase">{{$convenio->dt_cadastro}}</td>
                            <td class="text-uppercase">{{$convenio->protocolo}}</td>
                            <td class="text-uppercase">{{$convenio->valor_nf}}</td>
                            <td class="text-uppercase">{{$convenio->valor_pago}}</td>
                            <td class="text-uppercase">{{$convenio->dt_pagamento}}</td>
                            {{--<td class="text-uppercase">{{$convenio->porcentagem_gse}}</td>--}}
                            <td>
                                <a href="#" class="alterar_status_processo" data-toggle="modal" data-target="#alterar_status_processo" href="javascript:void(0);" data-idpropcesso="{{$convenio->id_convenio}}" alt="Alterar Situação do Processo" title="Alterar Situação do Processo">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                <a href="#" class="alterar_processo" data-toggle="modal" data-target="#alterar_processo" href="javascript:void(0);" data-idpropcesso="{{$convenio->id_convenio}}" alt="Alterar Processo" title="Alterar Processo">
                                    <i class="fas fa-pen-square"></i>
                                </a>
                                <a href="#" class="excluir_processo" data-toggle="modal" data-target="#excluir_processo" href="javascript:void(0);"  onclick="excluir_processo({{$convenio->id_convenio}},{{$convenio->protocolo}})"  alt="Excluir Processo" title="Excluir Processo">
                                    <i class="fas fa-trash"></i>
                                </a>
                                @if($convenio->status_situacao >= 2)
                                    <a href="#" class="adicionar_pendecia" data-toggle="modal" data-target="#adicionar_pendecia" href="javascript:void(0);" data-idpropcesso="{{$convenio->id_convenio}}" alt="Adicionar Pendencias" title="Adicionar Pendencias">
                                        <i class="fas fa-clipboard-list"></i>
                                    </a>
                                    <a href="#" class="upload" data-toggle="modal" data-target="#upload" href="javascript:void(0);" data-idpropcesso="{{$convenio->id_convenio}}" alt="Upload" title="Upload">
                                        <i class="fas fa-upload"></i>
                                    </a>
                                    <a href="#" class="lista_upload" data-toggle="modal" data-target="#lista_upload" href="javascript:void(0);" data-idpropcesso="{{$convenio->id_convenio}}" alt="Arquivos Upload" title="Arquivos Upload">
                                        <i class="fas fa-file-import"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>  
                    @endforeach
                @else
                    <tr>
                        <td colspan="12">
                            <div class="alert alert-danger">
                                <i class="glyphicon glyphicon-remove"></i>
                                <div class="mensagem">
                                    Nenhum Processo foi encontrado.
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
            Exibindo <b>{{count($convenios)}}</b> de <b>{{$convenios->total()}}</b> {{($convenios->total()>1?'pesquisas':'pesquisa')}}.
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="row justify-content-md-center">
            <div align="center">
                {{$convenios->fragment('convenio')->render()}}
            </div>
        </div>
    </div>
    
</div>



@stop
