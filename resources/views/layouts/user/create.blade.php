@extends('layouts.admin')

@section('title', 'create-user')

@section('content')
<div id="top-container" class="container-fluid p-0">

    <div class="form-title">
        <h1>アカウント作成</h1>
    </div>

    <form action="/users/create" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
    <ul>
    @foreach($errors->all() as $e)
    <li class="error-message">{{ $e }}</li>
    @endforeach
    </ul>
    @endif
    @csrf

        <input name="email" type="email" class="feedback-input" value="{{ old('email') }}" placeholder="メールアドレス" />
        <input name="password" type="password" class="feedback-input" value="{{ old('email') }}" placeholder="パスワード（半角英数字で8文字以上）" />
        <input name="password_confirmation" type="password" class="feedback-input" placeholder="パスワード確認用">
        <input name="user_name" type="text" class="feedback-input" value="{{ old('user_name') }}" placeholder="ニックネーム">
        <input type="date" name="birthday" class="feedback-input" value="{{ old('birthday') }}">
        <select name="sex" class="feedback-input" value="{{ old('sex') }}">
            <option value=0 class="feedback-option">男性</option>
            <option value=1 class="feedback-option">女性</option>
            <option value=2 class="feedback-option">その他</option>
        </select>
        <input name="former_job" type="text" class="feedback-input" value="{{ old('former_job') }}" placeholder="以前のお仕事">
        <input name="job" type="text" class="feedback-input" value="{{ old('job') }}" placeholder="現在のお仕事">
        <input type="submit" value="アカウントを作成"/>

    </form>
            
</div>
@endsection