@extends('layouts.admin')

@section('title', 'mypage')

@section('content')
<div class="container-xl">

<div class="row d-flex">

  <div class="user-nav col-md-3 mx-md-4 mb-auto" style="margin-top: 6.0rem;">
    <div class="card px-0">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <a href="#"><i class="fas fa-user"></i>{{ $profile_form->user_name }}</a>
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
            メールアドレス<span>{{ $profile_form->email }}</span><a href="{{ url('/email/edit') }}">メールアドレスを変更</a>
          </li>
          <li class="list-group-item">
            パスワード<span>パスワードは表示出来ません。</span><a href="{{ url('/password/change') }}">パスワードを変更</a>
          </li>
        </ul>
      </div>
    </div>

    <div id="user-prof" class="card" style="margin: 10.0rem 0;">
      <div class="card-header">プロフィール</div>
      <div class="card-body text-secondary">
        <ul class="list-group list-group-flush">

        <form action="{{ url('/users/edit') }}" method="get">
        @csrf
          <li class="list-group-item">ニックネーム<span>{{ $profile_form->user_name }}</span></li>
          <li class="list-group-item">生年月日<span>{{ $profile_form->birthday }}</span></li>
          
          @if ($profile_form->sex === 0)
          <li class="list-group-item">性別<span>男性</span></li>
          @elseif ($profile_form->sex === 1)
          <li class="list-group-item">性別<span>女性</span></li>
          @else
          <li class="list-group-item">性別<span>その他</span></li>
          @endif
          
          <li class="list-group-item">以前のご職業<span>{{ $profile_form->former_job }}</span></li>
          <li class="list-group-item">現在のご職業<span>{{ $profile_form->job }}</span></li>
          <li class="list-group-item"><a type="submit">プロフィールを変更</a></li>
        </form>
      </ul>
    </div>
  </div>
  
  </div>

</div>

</div>
@endsection