<form class="user">
    <input type="hidden" value="{{$request->id_propcesso}}" id="id_propcesso">
    <div class="form-group row">
        <div class="col">
          <select class="form-control" id="id_processo_status">
            @foreach ($processo_status as $status)
                 <option value="{{$status->id_processo_status }}">{{$status->nome_processo_status}}</option>
              @endforeach
          </select>
        </div>
    </div>
  </form>       