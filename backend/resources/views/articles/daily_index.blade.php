@extends('layouts/layout')

@section('title', '人気記事 - スぺベル')

@section('content')
@extends('layouts/header')
<div class="container">
  <div class="row row-eq-height">
    <div class="col-lg-7 col-lg-offset-1 ranking-cut">
      <h1 class="page-header">日間ランキング</h1>
      @foreach($paginatedArticles as $article)
        <div class="row ranking-space">
          <div class="col-lg-4">
            <img src="/show_image/thumb_main_{{$article->image}}">
          </div>
          <div class="col-lg-8">
            <h4 class="text-left"><a href="{{ route('articles.show', ['article' => $article->id]) }}">{{$article->title}}</a></h4>
            <br>
            <h5 class="text-left text-muted">{{mb_strimwidth($article->body, 0, 40, "...", "UTF-8" )}}</h5>
            <br>
            @foreach($article->tags as $tag)
              <div class="tag-design">
                <a href="/tags/{{$tag->id}}/tag_article_index" id="tag.id">{{$tag->name}}</a>
              </div>
            @endforeach
            <br>
            @if(Auth::check() && Auth::user()->admin)
              <form action="{{ route('articles.destroy', ['article' => $article]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
                <input type="submit" value="削除">
              </form>
            @endif
            <br>
          </div>
        </div>
      @endforeach
      <div>
        {{ $paginatedArticles->links() }}
      </div>    
    </div>

    <div class="col-lg-3">
        <h1 class="page-header">新着情報</h1>
        @foreach($articles as $article)
          <img src="/show_image/thumb_sub_{{$article->image}}">
          <a href="{{ route('articles.show', ['article' => $article->id]) }}">{{mb_strimwidth($article->title, 0, 12, "...", "UTF-8" )}}</a>
          <br><br>
        @endforeach
        <a href="{{route('articles.new_arrivals_index')}}">もっと見る</a>
      </div>
    </div>
  </div>
@endsection