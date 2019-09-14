@extends('layouts/layout')

@section('title','記事詳細ページ')

@section('content')
@extends('layouts/header')
  <div class="container">
    <div class="row row-eq-height">
      <div class="col-lg-7 col-lg-offset-1 ranking-cut">
        <h1 class="page-header">{{ $article->title }}</h1>
        <img src="/show_image/main_{{$article->image}}">
        <h4>{{ $article->body }}</h4><br>
        <h3 class="page-header">カテゴリー</h3>
        @foreach ($article->tags as $tag)
          <div class="tag-design h4">
            <a href="/tags/{{$tag->id}}/tag_article_index">{{$tag->name}}</a>
          </div>
        @endforeach<br>
        @if(Auth::check() && Auth::user()->admin)
          <a href="{{route('articles.edit',['article_id' => $article->id])}}">記事編集</a>
        @endif
      </div>
      <div class="col-lg-3">
        <h1 class="page-header">日間ランキング</h1>
        @foreach($articles_ranking_array as $article)
          <img src="/show_image/thumb_sub_{{$article->image}}">
          <a href="{{ route('articles.show', ['article' => $article->id]) }}">{{mb_strimwidth($article->title, 0, 12, "...", "UTF-8" )}}</a>
          <br><br>
        @endforeach
        <a href="{{route('articles.daily_index')}}">もっと見る</a>

        <h2 class="page-header">新着情報</h2>
        @foreach($new_articles as $article)
          <img src="/show_image/thumb_sub_{{$article->image}}">
          <a href="{{route('articles.show', ['article' => $article->id]) }}">{{mb_strimwidth($article->title, 0, 12, "...", "UTF-8" )}}</a>
          <br><br>
        @endforeach
        <a href="{{route('articles.new_arrivals_index')}}">もっと見る</a>
      </div>
    </div>
  </div>
  
@endsection