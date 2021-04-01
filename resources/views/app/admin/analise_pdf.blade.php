<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>{{env('APP_NAME')}}</title>

        <style>
            body {
                font-family:sans-serif;
                font-size:14px;
                padding:50px;
            }
            div#header {
                margin-bottom:50px;
                text-align:center;
            }
            div#footer {
                border:0px;
                position:fixed;
                width:100%;
            }

            table.table01 {
                border:1px solid #000;
                border-collapse:collapse;
            }
            table.table01 tr>th {
                vertical-align:top;
            }
            table.table01 tr>td {
                padding:0 8px 8px 8px;
                vertical-align:top;
            }
            table.table01 tr>td+td {
                border-left:1px solid #000;
            }
            table.bt-0 {
                border-top:0;
            }
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <img src="../public/img/logo.png" alt="{{env('APP_NAME')}}" width="150px" />
                    </td>
                    <td align="right">
                        Relatório Processo Analise 
                    </td>
                </tr>
            </table>
        </div>
        <h3 align="center">DADOS DOS PROCESSOS EM ANALISES</h3>
        <table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th>CLINICA</th>
                <th>NOME</th>
            </tr>
            @if (count($convenios)>0)
                @foreach ($convenios as $convenio)
                    <tr>  
                        <td>{{$convenio->nome_clinica}}</td>
                        <td>{{$convenio->nome_paciente}}</td>
                    </tr>  
                @endforeach
            @else
                <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-remove"></i>
                    <div class="mensagem">
                        Nenhum Processo foi encontrado.
                    </div>
                </div>
            @endif    
        </table>

        {{--<table class="table" cellpadding="0" cellspacing="0">
            <tr>
                <th>CLINICA</th>
                <th>NOME</th>
                <th>CONVENIO</th>
                <th>SITUAÇÃO</th>
                <th>CPF</th>
                <th>SENHA</th>
                <th>DATA</th>
                <th>PROTOCOLO</th>
                <th>VALOR NF</th>
                <th>VALOR PAGO</th>
                <th>DATA PAGAMENTO</th>
            </tr>
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
                    <td class="text-uppercase">{{$convenio->nome_processo_status}}</td>
                    <td class="text-uppercase">{{$convenio->cpf}}</td>
                    <td class="text-uppercase">{{$convenio->senha}}</td>
                    <td class="text-uppercase">{{$convenio->dt_cadastro}}</td>
                    <td class="text-uppercase">{{$convenio->protocolo}}</td>
                    <td class="text-uppercase">{{$convenio->valor_nf}}</td>
                    <td class="text-uppercase">{{$convenio->valor_pago}}</td>
                    <td class="text-uppercase">{{$convenio->dt_pagamento}}</td>
                </tr>  
            @endforeach
        @else
            <tr>
                <td colspan="11">
                    <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-remove"></i>
                        <div class="mensagem">
                            Nenhum Processo foi encontrado.
                        </div>
                    </div>
                </td>
            </tr>
        @endif
        </table>--}}    
    </body>
</html>

    

