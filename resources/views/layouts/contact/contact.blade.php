@extends('layouts.admin')

@section('title', 'contact')

@section('content')

  <div class="form-title">
    <h1>お問い合わせ</h1>
  </div>

  <form action="/contacts" method="POST" enctype="multipart/form-data">
  @if (count($errors) > 0)
    <ul>
    @foreach($errors->all() as $e)
    <li class="error-message">{{ $e }}</li>
    @endforeach
    </ul>
    @endif
    @csrf
       
    <input type="text" name="name"class="feedback-input" value="{{ old('name') }}" placeholder="お名前">

    <p class="form-item">アカウントをお持ちの方はチェックしてください。</p>
    <div class="feedback-input feedback-radio">
      <input type="radio" name="have_account" value=0 style="display: none;">
      <label><input type="radio" name="have_account" value=1 @if(old('have_account') == 1) checked="true" @endif>アカウントを持っている</label>
    </div>

    <input type="email" name="email" class="feedback-input" value="{{ old('email') }}" placeholder="メールアドレス">

    <input type="text" class="feedback-input" name="title" value="{{ old('title') }}">

    <textarea name="inquiry" class="feedback-input" value="{{ old('inquiry') }}" placeholder="お問い合わせ内容"></textarea>

    <input type="submit" value="送信"/>

  </form>
  
@endsection