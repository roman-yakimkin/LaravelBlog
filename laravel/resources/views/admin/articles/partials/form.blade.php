<label for="">Статус</label>
<select class="form-control" name="published">
    @if (isset($category->id))
        <option value="0" @if ($article->published==0) selected="" @endif>Не опубликовано</option>
        <option value="1" @if ($article->published==1) selected="" @endif>Опубликовано</option>
    @else
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    @endif
</select>

<label for="">Заголовок</label>
<input type="text" class="form-control" name="title" placeholder="Заголовок новости"
       value="{{$article->title ?? ""}}" reruired >

<label for="">Slug (уникальное значение)</label>
<input type="text" class="form-control" name="slug" placeholder="Автоматическая генерация"
       value="{{$category->slug ?? ""}}" readonly="" />

<label for="">Категории</label>
<select class="form-control" name="categories[]" multiple="">
    <option value="0">--без родительской категории--</option>
    @include("admin.articles.partials.categories", [
        'categories' => $categories
    ])
</select>

<label for="">Краткое описание</label>
<textarea class="form-control" id="description_short" name="description_short">{{$article->description_short ?? ""}}</textarea>

<label for="">Полное описание</label>
<textarea class="form-control" id="description" name="description">{{$article->description ?? ""}}</textarea>

<hr />

<label for="">Мета заголовок</label>
<input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Мета заголовок" value="{{$article->meta_title ?? ""}}">

<label for="">Мета описание</label>
<input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Мета описание" value="{{$article->meta_description ?? ""}}" >

<label for="">Ключевые слова</label>
<input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Мета ключевые слова, через запятую" value="{{$article->meta_keyword ?? ""}}" >

<hr />

<input type="submit" class="btn btn-primary" value="Сохранить">
