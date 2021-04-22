@csrf
<div class="md-form">
  <label>タイトル</label>
  <!-- null合体演算子 -->
  <input type="text" name="title" class="form-control" value="{{ $article->title ?? old('title') }}">
</div>
<div class="form-group">
  <article-tags-input :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'>
  </article-tags-input>
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="本文">
  {{ $article->body ?? old('body') }}</textarea>
</div>
