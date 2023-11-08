@csrf

<label for="">Titulo</label>
<input class="form-control" type="text" name="title" value="{{ old("title", $category->title) }}">

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" value="{{ old("slug", $category->slug) }}">

<label for="">Descripcion</label>
<textarea class="form-control" name="description">{{ old("description", $category->description)}}</textarea>

<button class="btn btn-success mt-3" type="submit">Enviar</button>