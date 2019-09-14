@extends('layouts/layout')

@section('title','管理者ページ')

@section('content')
@extends('layouts/header')

<h1>管理者ページ</h1>
<div class="row">
  <div class="col-md-2 col-md-offset-1">
    <a href="{{route('articles.create')}}" class='btn btn-danger btn-lg'>記事作成</a>
  </div>
  <div class="col-md-2">
    <a href="/" class='btn btn-primary btn-lg'>記事一覧</a>
  </div>
  <div class="col-md-2">
    <a href="{{route('tags.index')}}" class='btn btn-success btn-lg'>タグ一覧</a>
  </div>
  <div class="col-md-2">
    <a href="{{route('tags.create')}}" class='btn btn-info btn-lg'>タグ作成</a>
  </div>
  <div class="col-md-2">
    <a href="{{route('users.index')}}" class='btn btn-warning btn-lg'>ユーザー一覧</a>
  </div>
</div>


@endsection