<form class="user" name="form-alterar-processo">
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
          <option value="{{$convenio->tipo_convenio}}">{{$convenio->tipo_convenio}}</option>
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
          <option value="{{$convenio->tipo_plano}}">{{$convenio->tipo_plano}}</option>
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
          <input type="text" class="form-control" id="numero_carterinha" placeholder="Nº CARTEIRINHA" value="{{$convenio->numero_carterinha}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="cpf" placeholder="CPF" value="{{$convenio->cpf}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="senha" placeholder="SENHA" value="{{$convenio->senha}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <select class="form-control" id="tipo_envio">
          <option value="{{$convenio->tipo_envio}}">{{$convenio->tipo_envio}}</option>
          <option value="REEMBOLSO">REEMBOLSO</option>
          <option value="CIRURGIA">CIRURGIA</option>
          <option value="PREVIA">PREVIA</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="protocolo" placeholder="PROTOCOLO"  value="{{$convenio->protocolo}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="valor_nf" placeholder="VALOR NF" value="{{$convenio->valor_nf}}">
      </div>
    </div>

    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="valor_pago" placeholder="VALOR PAGO" value="{{$convenio->valor_pago}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="dt_pagqamento" placeholder="DATA PAGAMENTO" value="{{$convenio->dt_pagamento}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="porcentagem_gse" placeholder="% GSE" value="{{$convenio->porcentagem_gse}}">
      </div>
    </div>
</form>