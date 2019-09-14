@extends('layouts/layout')

@section('title', 'タグ一覧 -スぺベル')

@section('content')
@extends('layouts/header')
<div class="container">
  <div class="row">
    <h1>タグ一覧ページ</h1>
    <a href="{{route('tags.create')}}">タグ作成</a>
    @foreach($tags as $tag)
      <div class="tag-design">
        <a href="{{route('tags.edit',['tag' => $tag])}}" class="h3">{{ $tag->name }}</a>
      </div>
    @endforeach
@endsection