@extends('layouts/layout')

@section('title','記事作成ページ')

@extends('layouts/header')

@section('content')
<div class = "row">
  <div class = "col-md-6 col-md-offset-3">
    <h1 class= "title">記事作成</h1>
    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}

      <label for="article_title">タイトル</label>
      <input type="text" name="title" value="{{old('title')}}" class="form-control" id="article_title">
      @if($errors->has('title'))
        <p>{{$errors->first('title')}}</p>
      @endif

      <label for="article_image">画像</label>
      <input type="file" name="image" class="form-control" id="article_image">
      @if($errors->has('image'))
        <p>{{$errors->first('image')}}</p>
      @endif

      <label for="article_body">本文</label>
      <textarea name="body" rows="5" class="form-control" id="article_body">{{old('body')}}</textarea>
      @if($errors->has('body'))
        <p>{{$errors->first('body')}}</p>
      @endif
      
      @foreach ($tags as $tag)
        <div class="form-check">
          <label>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input">
            {{ $tag->name }}
          </label>
          </div>
      @endforeach
      <input type="submit" value="記事作成" class="btn btn-primary center-block">
    </form>
  </div>
</div>
@endsection