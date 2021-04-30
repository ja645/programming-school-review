@extends('layouts.admin')

@section('title', 'mypage')

@section('content')
<div class="container-xl">

<div class="row d-flex">

  <div class="user-nav col-md-3 mx-md-4 mb-auto" style="margin-top: 6.0rem;">
    <div class="card px-0">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a href="#"><i class="fas fa-user"></i>hogehoge</a>
        </li>
        <li class="list-group-item">
          <a href="#"><i class="far fa-file-alt"></i>投稿したレビュー</a>
        </li>
        <li class="list-group-item">
          <a href="#"><i class="fas fa-heart"></i>お気に入り</a>
        </li>
        <li class="list-group-item">
          <a href="#"><i class="far fa-thumbs-up"></i>評価したレビュー</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="col-md-8 me-auto">
    <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">
      <div class="card-header">会員情報</div>
      <div class="card-body text-secondary">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            メールアドレス<span>hogehoge@hoge.com</span><a href="#">メールアドレスを変更</a>
          </li>
          <li class="list-group-item">
            パスワード<span>password</span><a href="#">パスワードを変更</a>
          </li>
        </ul>
      </div>
    </div>

    <div id="user-prof" class="card" style="margin: 10.0rem 0;">
      <div class="card-header">プロフィール</div>
      <div class="card-body text-secondary">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">ユーザー名<span>hogehoge</span></li>
          <li class="list-group-item">生年月日<span></span></li>
          <li class="list-group-item">性別<span>hoge</span></li>
          <li class="list-group-item">以前のご職業<span>hoge</span></li>
          <li class="list-group-item">現在のご職業<span>hoge</span></li>
          <li class="list-group-item"><a href="#">プロフィールを変更</a></li>
        </ul>
      </div>
    </div>

  </div>

</div>

</div>
@endsection