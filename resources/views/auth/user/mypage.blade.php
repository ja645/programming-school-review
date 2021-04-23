@extends('layouts.admin')

@section('title', 'mypage')

@section('content')
<div class="container-xl">

  <div class="row d-flex">

    <div class="user-nav col-md-3 mx-md-4 mb-auto" style="margin-top: 6.0rem;">
      <div class="card px-0">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <a href="#"><i class="fas fa-user"></i>{{ $profile->user_name }}</a>
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
      <div class="user-info card border-secondary p-0" style="margin-top: 6.0rem;">
        <div class="card-header">会員情報</div>
        <div class="card-body text-secondary">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              メールアドレス<span>{{ $profile->email }}</span><a href="#">メールアドレスを変更</a>
            </li>
            <li class="list-group-item">
              パスワード<span>{{ $profile->password }}</span><a href="#">パスワードを変更</a>
            </li>
          </ul>
        </div>
      </div>
  
      <div class="user-prof card border-secondary" style="margin: 10.0rem 0;">
        <div class="card-header">プロフィール</div>
        <div class="card-body text-secondary">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ユーザー名<span>{{ $profile->user_name}}</span></li>
            <li class="list-group-item">生年月日<span>{{$profile->birthday->format('Y年m月d日') }}</span></li>
            <li class="list-group-item">性別<span>{{ $profile->sex }}</span></li>
            <li class="list-group-item">以前のご職業<span>{{ $profile->former_job }}</span></li>
            <li class="list-group-item">現在のご職業<span>{{ $profile->job }}</span></li>
            <li class="list-group-item"><button　type="button" class="btn btn-outline-success btn-lg">プロフィールを変更</button></li>
          </ul>
        </div>
      </div>

    </div>

  </div>

</div>
@endsection