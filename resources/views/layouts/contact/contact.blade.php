@extends('layouts.admin')

@section('title', 'contact')

@section('content')
<div class="container-xl">

  <div class="row d-flex justify-content-center">
    
    <div class="col-md-8">
      <form action="/contacts" method="POST" enctype="multipart/form-data">
      @if (count($errors) > 0)
        <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
        </ul>
        @endif
        @csrf
        <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">
          <div class="card-header">お客様の情報を入力してください。</div>
          <div class="card-body text-secondary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                  <label for="name">お名前を教えてください。</label>
                  <input type="text" name="name" value="{{ old('name') }}" placeholder="お名前を入力してください。">
              </li>
              <li class="list-group-item">
                <p>アカウントをお持ちの方はチェックしてください。</p>
                <div>
                  <input type="radio" name="have_account" value=0 style="display: none;">
                  <label><input type="radio" name="have_account" value=1 @if(old('have_account') == 1) checked="true" @endif>アカウントを持っている</label>
                </div>
              </li>
              <li class="list-group-item">
                  <label for="email">メールアドレスを入力してください。</label>
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力してください。">
              </li>
            </ul>
          </div>
        </div>

        <div id="user-prof" class="card" style="margin: 10.0rem 0;">
          <div class="card-header">お問い合わせ内容を入力してください。</div>
          <div class="card-body text-secondary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <label for="title">件名(30字以内でご入力ください。)</label>
                <input type="text" name="title" value="{{ old('title') }}">
              </li>                
              <li id="has-textarea" class="list-group-item">
                <label for="inquiry">お問い合わせ内容</label>
                <textarea id="report" name="inquiry" value="{{ old('inquiry') }}"></textarea>
              </li>                
              <li class="list-group-item">
                  <button type="submit" class="btn btn-success" data-bs-container="body">
                    送信
                  </button>
              </li>
            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection