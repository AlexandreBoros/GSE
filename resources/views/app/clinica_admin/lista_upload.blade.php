
<script>

$(document).ready(function() {

  $('#table_clinica_lista_arquivos').DataTable();

});

</script>

<table id="table_clinica_lista_arquivos" class="display" style="width:100%">
  <thead>
    <tr>
        <th>Arquivo</th>
        <th>Download</th>
    </tr>
  </thead>
  <tbody>               
    @foreach ($processo_arquivos->get() as $processo_arquivo)
        <tr> 
            <td>{{$processo_arquivo->nome_real}}</td>
            <td>
                <a href="{{route("app.clinica.download", $processo_arquivo->id_processo_arquivos)}}">
                    <button class="btn btn-primary upload-arquivo">Download</button>
                </a>
            </td>
        </tr>  
    @endforeach
  </tbody>
</table>