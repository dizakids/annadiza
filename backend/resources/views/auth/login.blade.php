@extends('layouts/layout')

@section('content')
@extends('layouts/header')

<div class = "col-md-6 col-md-offset-3">
  <h1 class= "title">ログイン</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email" class="form-controll">メールアドレス</label>
    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
    @if ($errors->has('email'))
      <p>{{ $errors->first('email') }}</p>
    @endif

    <label for="password" class="form-controll">パスワード</label>
    <input id="password" type="password" class="form-control" name="password">

    @if ($errors->has('password'))
      <p>{{ $errors->first('password') }}</p>
    @endif

    <input class="form-check-input" type="checkbox" name="remember" id="remember">
    <label class="form-check-label" for="remember">
      記憶する
    </label>
    <p>
    <button type="submit" class="btn btn-primary">ログイン</button>
    </p>
  </form>
</div>
@endsection
