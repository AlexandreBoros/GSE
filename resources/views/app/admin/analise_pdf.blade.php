

<div class="table-responsive">
        <!--<table id="table_admin" class="display" style="width:100%">-->
        <table id="table_alunos" class="table" style="width:100%">    
            <thead>
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
