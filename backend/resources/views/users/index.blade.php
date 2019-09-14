@extends('layouts/layout')
@section('title','ユーザー一覧ページ')

@section('content')
@extends('layouts/header')

<form action="{{url('/users')}}">
  <input type="text" name="keyword" value="{{$keyword}}" class="form-control" placeholder="メールアドレスを入力してください">
  <input type="submit" value="検索" class="btn btn-info">
</form>

@if(!empty($keyword))
  <h1>検索結果</h1>
  <table class="user-info">
    <tr>
      <th>名前</th><th>性別</th><th>年齢</th><th>メールアドレス</th><th>都道府県</th>
      <th>市区町村</th><th>その他</th>
    </tr>
    @foreach($data as $user)
      <tr>     
        <td><a href="{{route('users.edit',['user_id' => $user->id])}}">{{$user->name}}</a></td>
        <td>{{$user->gender}}</td>
        <td>{{$user->age}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->post_code}}</td>
        <td>{{$prefs[$user->prefecture_code]}}</td>
        <td>{{$user->address}}</td>
      </tr>
    @endforeach
  </table>
@endif


<h1>ユーザー一覧</h1>
<table class="user-info">
  <tr>
    <th>名前</th><th>性別</th><th>年齢</th><th>メールアドレス</th><th>都道府県</th>
    <th>市区町村</th><th>その他</th>
  </tr>
  @foreach($users as $user)
    <tr>     
      <td><a href="{{route('users.edit',['user_id' => $user->id])}}">{{$user->name}}</a></td>
      <td>{{$user->gender}}</td>
      <td>{{$user->age}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->post_code}}</td>
      <td>{{$prefs[$user->prefecture_code]}}</td>
      <td>{{$user->address}}</td>
    </tr>
  @endforeach
</table>

@endsection