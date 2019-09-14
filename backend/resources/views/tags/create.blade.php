@extends('layouts/layout')

@section('title','スぺベル--タグ作成')

@section('content')
@extends('layouts/header')
  <h1>タグ作成</h1>
  <form action="{{ route('tags.store') }}" method="post">
    {{csrf_field()}}
    <label for="tag_name">名前</label>
    <input type="text" name="name" value="{{old('name')}}" id="tag_name">
    @if($errors->has('name'))
      <p>{{$errors->first('name')}}</p>
    @endif
    <input type="submit" value="作成">
  </form>
@endsection