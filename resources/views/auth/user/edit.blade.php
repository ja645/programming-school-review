@extends('layouts.admin')

@section('title', 'edit-user')

@section('content')
<div class="container-xl">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">
        
        <form action="/users/update" method="post" enctype="multipart/form-data">
        @if (count($errors) > 0)
        <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
        </ul>
        @endif
        @csrf
            <div id="user-prof" class="card" style="margin: 10.0rem 0;">
            <div class="card-header">プロフィール</div>
            <div class="card-body text-secondary">
                <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <label for="user_name">ニックネーム</label>
                    <input type="text" name="user_name" value="{{ old('user_name', $profile_form->user_name) }}" placeholder="ニックネームを入力してください。">
                </li>
                <li id="birthday" class="list-group-item">
                    <label for="birthday">生年月日</label>
                    <input type="date" name="birthday" value="{{ old('birthdat', $profile_form->birthday) }}">
                </li>
                <li id="sex" class="list-group-item">
                    <label for="sex">性別</label>
                    <select name="sex" value="{{ old('sex', $profile_form->sex) }}">
                        <option value=0>男性</option>
                        <option value=1>女性</option>
                        <option value=2>その他</option>
                    </select>
                </li>
                <li class="list-group-item">
                    <label for="former_job">以前のご職業</label>
                    <input type="text" name="former_job" value="{{ old('former_job', $profile_form->former_job) }}" placeholder="以前のお仕事を入力してください。">
                </li>
                <li class="list-group-item">
                    <label for="job">現在のご職業</label>
                    <input type="text" name="job" value="{{ old('job', $profile_form->job) }}" placeholder="現在のお仕事を入力してください。">
                </li>
                <li class="list-group-item">
                    <button type="submit" class="btn btn-success" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                        この内容に変更する
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