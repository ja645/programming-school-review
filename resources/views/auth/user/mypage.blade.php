@extends('layouts.admin')

@section('title', 'mypage')

@section('content')

  <div class="form-title">
    <h1>{{ $profile_form->user_name }}さんのマイページ</h1>
  </div>

  <div class="row d-flex justify-content-between m-0">
    <div class="col-md-1"></div>
    <div class="user-nav col-md-3" style="margin-top: 6.0rem;">
      
        <ul class="list-group list-group-flush">
          
          <a href="{{ route('user.review') }}" class="list-group-item"><i class="far fa-file-alt"></i>投稿したレビュー</a>
        
          <a href="{{ route('review.add') }}" class="list-group-item"><i class="fas fa-pen-nib"></i>レビューを投稿する</a>
        
          <a href="{{ route('user.likes') }}" class="list-group-item"><i class="fas fa-heart"></i>いいねしたスクール</a>
        
          <a href="{{ route('user.followings') }}" class="list-group-item"><i class="far fa-thumbs-up"></i>評価したレビュー</a>
        
        </ul>
      
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-6">
      <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">
        <div class="card-header">会員情報</div>
        <div class="card-body text-secondary">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              メールアドレス<span>{{ $profile_form->email }}</span><a href="{{ route('email.edit') }}">メールアドレスを変更</a>
            </li>
            <li class="list-group-item">
              パスワード<span>パスワードは表示出来ません。</span><a href="{{ route('password.request') }}">パスワードを変更</a>
            </li>
          </ul>
        </div>
      </div>

      <div id="user-prof" class="card" style="margin: 10.0rem 0;">
        <div class="card-header">プロフィール</div>
        <div class="card-body text-secondary">
          <ul class="list-group list-group-flush">

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
          </ul>
        </div>
      </div>
    </div>
    
    <div class="col-md-1"></div>
    
    
  </div>
  
  <form action="{{ route('user.edit') }}" method="get">
    <input type="submit" value="プロフィールを変更"/>
  </form>

@endsection