@extends('layouts.admin')

@section('title', 'edit-user')

@section('content')
<div id="top-container" class="container-fluid p-0">
        
    <div class="form-title">
        <h1>プロフィール編集</h1>
    </div>

    <form action="/users/update" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
    <ul>
    @foreach($errors->all() as $e)
    <li class="error-message">{{ $e }}</li>
    @endforeach
    </ul>
    @endif
    @csrf
           
        <input name="user_name" type="text" class="feedback-input" value="{{ old('user_name', $profile_form->user_name) }}" placeholder="ニックネーム">
        <input type="date" name="birthday" class="feedback-input" value="{{ old('birthday', $profile_form->use_name) }}">
        <select name="sex" class="feedback-input" value="{{ old('sex', $profile_form->sex) }}">
            <option value=0 class="feedback-option">男性</option>
            <option value=1 class="feedback-option">女性</option>
            <option value=2 class="feedback-option">その他</option>
        </select>
        <input name="former_job" type="text" class="feedback-input" value="{{ old('former_job', $profile_form->former_job) }}" placeholder="以前のお仕事">
        <input name="job" type="text" class="feedback-input" value="{{ old('job', $profile_form->job) }}" placeholder="現在のお仕事">
        <input type="submit" value="編集"/>

    </form>

</div>
@endsection