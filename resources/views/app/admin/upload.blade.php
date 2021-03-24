<form class="user" action="{{route("app.admin.salvar_upload")}}" method="post" id="form_upload" enctype="multipart/form-data">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" value="{{$request->id_propcesso}}" id="id_propcesso" name="id_propcesso">
    <div class="form-group row">
        <div class="col">
            <input class="" type="file" name="image">
        </div>
    </div>
</form>