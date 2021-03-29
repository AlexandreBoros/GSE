@extends('layouts.admin')

@section('titulo', 'GSE')

@section('content')


<style>
    .azul { background-color: #4e73df; text-align: left; color: white}
    .vermelho { background-color: #e74a3b; text-align: left; color: white}

</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-uppercase">{{Auth::user()->name}}</h1>
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#convenioModal">
        <i class="fas fa-download fa-sm text-white-50"></i> Novo Processo
    </a>
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

<style>
    .analise { background-color: rgb(253, 250, 239); text-align: left; color: rgb(5, 0, 0)}
    .pendente { background-color: #ff1d0d; text-align: left; color: white}
    .pago { background-color: #1cf082; text-align: left; color: white}
    .baixado { background-color: #f5ef3d; text-align: left; color: rgb(110, 54, 230)}
</style>



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
                            <td class="text-uppercase">{{$convenio->porcentagem_gse}}</td>
                            <td>
                                <a href="#" class="alterar_status_processo" data-toggle="modal" data-target="#alterar_status_processo" href="javascript:void(0);" data-idpropcesso="{{$convenio->id_convenio}}" alt="Alterar Situação do Convenio" title="Alterar Situação do Convenio">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                @if($convenio->status_situacao == 2)
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
                        <td colspan="5">
                            <div class="alert alert-danger">
                                <i class="glyphicon glyphicon-remove"></i>
                                <div class="mensagem">
                                    Nenhum convenio foi encontrado.
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
