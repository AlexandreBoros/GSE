<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>{{env('APP_NAME')}}</title>

        <style>
            body {
                font-family:sans-serif;
                font-size:8px;
                padding:10px;
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
            {{--<table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <img src="../public/img/logo.png" alt="{{env('APP_NAME')}}" width="150px" />
                    </td>
                    <td align="right">
                        {{$titulo}}
                    </td>
                </tr>
            </table>--}}
        </div>
        <h3 align="center">{{$titulo1}}</h3>
        <h3 align="center">VALOR TOTAL R$ {{$valor_total}}</h3>
        <table class="table01" cellpadding="0" cellspacing="0">
            <tr>
                <th>CLINICA</th>
                <th>NOME</th>
                <th>CONVENIO</th>
                {{--<th>CPF</th>
                <th>SENHA</th>--}}
                <th>DATA</th>
                {{--<th>PROTOCOLO</th>--}}
                <th>VALOR NF</th>
                <th>VALOR PAGO</th>
                <th>DATA PAGAMENTO</th>
                <th>LIB</th>
                <th>TEL</th>
                <th>PIX</th>
            </tr>
            @if (count($convenios)>0)
                @foreach ($convenios as $convenio)
                    <tr>
                        <td>{{$convenio->nome_clinica}}</td>
                        <td>{{$convenio->nome_paciente}}</td>
                        <td>{{$convenio->tipo_convenio}}</td>
                        {{--<td>{{$convenio->cpf}}</td>
                        <td>{{$convenio->senha}}</td>--}}
                        <td>{{Carbon\Carbon::parse($convenio->dt_cadastro)->format('d/m/Y H:i:s')}}</td>
                        {{--<td>{{$convenio->protocolo}}</td>--}}
                        <td>{{$convenio->valor_nf}}</td>
                        <td>{{$convenio->valor_pago}}</td>
                        <td>{{$convenio->dt_pagamento}}</td>
                        <td>{{$convenio->liberacao}}</td>
                        <td>{{$convenio->tel_paciente}}</td>
                        <td>{{$convenio->pix}}</td>
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
    </body>
</html>



