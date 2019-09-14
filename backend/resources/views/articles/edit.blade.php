@extends('layouts/layout')

@section('title', '記事編集ページ')

@section('content')
@extends('layouts/header')
  <div class = "row">
    <div class = "col-md-6 col-md-offset-3">
      <h1 class= "title">記事編集ページ</h1>
      <form action="{{ route('articles.update', ['article' => $article]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <label for="article_title">タイトル</label>
        <input type="text" name="title" value="{{$article->title}}" id="article_title" class="form-control">
        @if($errors->has('title'))
          <p>{{$errors->first('title')}}</p>
        @endif

        <label for="article_image">画像</label>
        <input type="file" name="image" id="article_image" class="form-control">
        @if($errors->has('image'))
          <p>{{$errors->first('image')}}</p>
        @endif

        <label for="article_body">本文</label>
        <textarea name="body" rows="5" id="article_body" class="form-control">{{$article->body}}</textarea>
        @if($errors->has('body'))
          <p>{{$errors->first('body')}}</p>
        @endif

        @foreach ($tags as $tag)
          <div class="form-check">
            <label>
              <input type="checkbox" name="tags[]" class="form-check-input" value="{{ $tag->id }}"
              @foreach($article->tags as $tag_relation)
                @if($tag_relation->id == $tag->id)
                  checked
                  break;
                @endif
              @endforeach
              >
              {{ $tag->name }}
            </label>
          </div>
        @endforeach
        <input type="submit" value="記事変更" class="btn btn-primary center-block">
      </form>
      
      <form action="{{ route('articles.destroy', ['article' => $article]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE')}}
        <input type="submit" value="削除">
      </form>
    </div>
  </div>
@endsection