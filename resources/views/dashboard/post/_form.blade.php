@csrf

<label for="">Titulo</label>
<input type="text" class="form-control" name="title" value="{{ old("title", $post->title) }}">

<label for="">Slug</label>
<input type="text" class="form-control" name="slug" value="{{ old("slug", $post->slug) }}">

<label for="">Categoria</label>
<select class="form-control" name="category_id" id="category:id">
    @foreach ($categories as $title => $id)
        <option {{ old("category_id", $post->category_id) == $id ? "selected" : "" }} value="{{ $id }}">{{ $title }}</option>
    @endforeach
</select>

<label for="">Posteado</label>
<select class="form-control" name="posted" id="posted">
    <option {{ old("posted", $post->posted) =="not" ? "selected" : "" }} value="not">No</option>
    <option {{ old("posted", $post->posted) =="yes" ? "selected" : "" }} value="yes">Si</option>
</select>

<label for="">Contenido</label>
<textarea class="form-control" name="content">{{ old("content", $post->content)}}</textarea>

<label for="">Descripcion</label>
<textarea class="form-control" name="description">{{ old("description", $post->description)}}</textarea>

@if (isset($task) && $task == "edit")
    <label for="">Imagen</label>
    <input type="file" name="image">
@endif

<button class="btn btn-success mt-3" type="submit">Enviar</button>