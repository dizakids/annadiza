@extends('layouts/layout')

@section('title','ユーザー情報変更')

@section('content')
@extends('layouts/header')
  <div class="row">
    <div class = "col-md-6 col-md-offset-3">
      <h1 class= "title">アカウント設定</h1>
      <form method="POST" action="{{ route('register') }}">
        {{csrf_field()}}

        <label for="user_name">名前</label>
        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="user_name">        
        @if ($errors->has('name'))
        <p>{{ $errors->first('name') }}</p>
        @endif

        <label for="user_email">メールアドレス</label>
        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="user_email">        
        @if ($errors->has('email'))
          <p>{{ $errors->first('email') }}</p>
        @endif

        <label for="user_age">年齢</label>
        <input type="number" name="age" value="{{old('age')}}" class="form-control" id="user_age">
        @if($errors->has('age'))
          <p>{{$errors->first('age')}}</p>
        @endif

        <label for="user_gender">性別</label>
        <select name="gender" class="form-control" id="user_gender">
          <option value="">選択してください</option>
          <option value="男性" @if(old('gender') == '男性') selected @endif>男性</option>
          <option value="女性" @if(old('gender') == '女性') selected @endif>女性</option>
        </select>
        @if($errors->has('gender'))
          <p>{{$errors->first('gender')}}</p>
        @endif

        <label for="user_post_code">郵便番号</label>
        <input type="text" name="post_code" value="{{old('post_code')}}" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','prefecture_code','address');" class="form-control" id="user_post_code">
        @if($errors->has('post_code'))
          <p>{{$errors->first('post_code')}}</p>
        @endif

        <label for="user_prefecture_code">都道府県</label>
        <select name="prefecture_code" class="form-control" id="user_prefecture_code">
          <option value="">-- 選択してください --</option>
        @foreach($prefs as $index => $name)
          <option value="{{ $index }}" @if(old('prefecture_code') == $index) selected @endif>{{$name}}</option>
        @endforeach
        </select>
        @if($errors->has('prefecture_code'))
          <p>{{$errors->first('prefecture_code')}}</p>
        @endif

        <label for="user_address">市区町村番地など </label>
        <input type="text" name="address" value="{{old('address')}}" size="60" class="form-control" id="user_address">
        @if($errors->has('address'))
          <p>{{$errors->first('address')}}</p>
        @endif

        @foreach ($tags as $tag)
          <div class="form-check">
            <label>
              <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input">
              {{ $tag->name }}
            </label>
          </div>
        @endforeach

        <label for="user_password">パスワード</label>
        <input type="password" name="password" class="form-control" id="user_password">      
        @if ($errors->has('password'))
          <p>{{ $errors->first('password') }}</p>
        @endif

        <label for="user_password_confirmation">パスワード確認</label>
        <input type="password" name="password_confirmation" class="form-control" id="user_password_confirmation">
      
        <input type="submit" value="変更" class="btn btn-primary center-block">
      </form>

    </div>
  </div>
@endsection