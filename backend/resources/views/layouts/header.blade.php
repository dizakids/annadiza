<div class="container">
  <div class="row">
  <h5 class="col-lg-3 col-lg-offset-9 text-center">
    @if(Auth::check())
      <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        ログアウト
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      <a href="{{route('users.edit',['user_id' => Auth::user()])}}">ユーザー編集</a>
    @else
      <a href="{{ route('login') }}">ログイン</a>
      <a href="{{ route('register') }}">ユーザー登録</a>
    @endif

    @if(Auth::check() && Auth::user()->admin)
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
          <a href="/manager">管理者ページ</a>
        <div>
      </div>
    @endif
  </h5>
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3 text-center"> 
      <a href="/">
        <!--
        <img src="/show_image/title.png">
        -->
        <img src="/storage/images/title.png">
      </a>
    </div>
  </div>
  <h5 class="text-center subtitle">旅行キュレーションメディア</h5>
  

  <nav class="tag-nav">
    <ul class="row">
      @foreach($tags as $tag) 
        <li>
          <a href="/tags/{{$tag->id}}/tag_article_index" id="tag.id">{{$tag->name}}</a>
        </li>
      @endforeach
    </ul>
  </nav>
</div>