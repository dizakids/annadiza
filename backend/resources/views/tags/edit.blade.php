@extends('layouts/layout')

@section('title', 'スぺベル--タグ表示')

@section('content')
@extends('layouts/header')
  <h1>編集</h1>
  <form action="{{route('tags.update',['tag' => $tag])}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}

    <label for="tag_name">タグ名</label>
    <input type="text" name="name" value="{{$tag->name}}" id="tag_name">
    @if($errors->has('name'))
      <p>{{$errors-first('name')}}</p>
    @endif
    <input type="submit" value="変更">
  </form> 

  <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE')}}
    <input type="submit" value="削除">
  </form>
@endsection