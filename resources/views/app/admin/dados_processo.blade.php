<form class="user">
    <input type="hidden" value="{{$request->id_propcesso}}" id="id_propcesso">
    <div class="form-group row">
        <div class="col">
          <select class="form-control" id="clinica">
            @foreach ($clinicas as $clinica)
                 <option value="{{$clinica->id_clinica}}" @if($clinica->id_clinica == $convenio->id_clinica) selected="selected" @endif>{{$clinica->nome_clinica}}</option>
              @endforeach
          </select>
        </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="nome_paciente" placeholder="NOME PACIENTE" value="{{$convenio->nome_paciente}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <select class="form-control" id="convenio">
          <option>SELECIONE O CONVENIO</option>
          <option value="AMIL">AMIL</option>
          <option value="BRADESCO">BRADESCO</option>
          <option value="MEDSERVICE">MEDSERVICE</option>
          <option value="SEGURO UNIMED">SEGURO UNIMED</option>
          <option value="SULAMERICA">SULAMERICA</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <select class="form-control" id="plano">
          <option>SELECIONE O PLANO</option>
          <option value="A PARTIR DE 500">A PARTIR DE 500</option>
          <option value="BASICO">BASICO</option>
          <option value="ESPECIAL 100">ESPECIAL 100</option>
          <option value="EXATO">EXATO</option>
          <option value="TODOS">TODOS</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="numero_carterinha" placeholder="Nº CARTEIRINHA">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="cpf" placeholder="CPF">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="senha" placeholder="SENHA">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <select class="form-control" id="tipo_envio">
          <option>SELECIONE O TIPO DE ENVIO</option>
          <option value="REEMBOLSO">REEMBOLSO</option>
          <option value="CIRURGIA">CIRURGIA</option>
          <option value="PREVIA">PREVIA</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="protocolo" placeholder="PROTOCOLO">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="valor_nf" placeholder="VALOR NF">
      </div>
    </div>

    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="valor_pago" placeholder="VALOR PAGO">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="dt_pagqamento" placeholder="DATA PAGAMENTO">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="porcentagem_gse" placeholder="% GSE">
      </div>
    </div>
</form>