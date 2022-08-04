<script async>
  $(document).ready(function() {
    $('.real').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
  });
</script>
<form class="user" name="form-alterar-processo">
    <input type="hidden" value="{{$request->id_propcesso}}" id="id_propcesso">
    <div class="form-group row">
        <div class="col">
          <select class="form-control" id="id_clinica_processo">
            @foreach ($clinicas as $clinica)
                 <option value="{{$clinica->id_clinica}}" @if($clinica->id_clinica == $convenio->id_clinica) selected="selected" @endif>{{$clinica->nome_clinica}}</option>
              @endforeach
          </select>
        </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="nome_paciente_processo" placeholder="NOME PACIENTE" value="{{$convenio->nome_paciente}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <select class="form-control" id="convenio_processo">
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
        <select class="form-control" id="plano_processo">
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
          <input type="text" class="form-control" id="numero_carterinha_processo" placeholder="Nº CARTEIRINHA" value="{{$convenio->numero_carterinha}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="cpf_processo" placeholder="CPF" value="{{$convenio->cpf}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="senha_processo" placeholder="SENHA" value="{{$convenio->senha}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
        <select class="form-control" id="tipo_envio_processo">
          <option value="{{$convenio->tipo_envio}}">{{$convenio->tipo_envio}}</option>
          <option value="REEMBOLSO">REEMBOLSO</option>
          <option value="CIRURGIA">CIRURGIA</option>
          <option value="PREVIA">PREVIA</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="protocolo_processo" placeholder="PROTOCOLO"  value="{{$convenio->protocolo}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control real" id="valor_nf_processo" placeholder="VALOR NF" value="{{$convenio->valor_nf}}">
      </div>
    </div>

    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control real" id="valor_pago_processo" placeholder="VALOR PAGO" value="{{$convenio->valor_pago}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="dt_pagqamento_processo" placeholder="DATA PAGAMENTO" value="{{$convenio->dt_pagamento}}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col">
          <input type="text" class="form-control" id="porcentagem_gse_processo" placeholder="% GSE" value="{{$convenio->porcentagem_gse}}">
      </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <select class="form-control" name="liberacao">
              <option value="{{$convenio->liberacao}}">{{$convenio->tipo_envio}}</option>
              <option value="OP">OP</option>
              <option value="CC">CC</option>
            </select>
          </div>
    </div>
    <div class="form-group row">
        <div class="col">
            <textarea rows="5" class="form-control" name="obs" placeholder="OBS">{{$convenio->obs}}</textarea>
        </div>
    </div>
</form>
