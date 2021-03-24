<form class="user">
    <input type="hidden" value="{{$request->id_propcesso}}" id="id_propcesso">
    <div class="form-group row">
        <div class="col">
            <textarea class="form-control" id="pendencia_texto" disabled>{{$texto}}</textarea> 
        </div>
    </div>
</form>       