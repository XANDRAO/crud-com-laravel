@csrf
<div class="form-group">
    <input type="text" value= "{{ $category->title ?? old('title') }}" name="title" class="form-control" id="" placeholder="titulo">
</div>
<div class="form-group">
    <input type="text" value= "{{  $category->url ?? old('url')}}"  name="url" class="form-control" placeholder="url">
</div>
<textarea name="description" class="form-control" cols="30" rows="3" placeholder="descrição">{{  $category->description ?? old('description') }}</textarea>
        <button type="submit" class="btn btn-sucess">Enviar</button>
</div>
