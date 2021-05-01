@extends('layouts.admin')

@section('title', 'create-user')

@section('content')
<div class="container-xl">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">
            <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">
            <div class="card-header">会員情報登録</div>
            <div class="card-body text-secondary">
                <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" placeholder="メールアドレスを入力してください。">
                </li>
                <li class="list-group-item">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" placeholder="半角英数字をそれぞれ1字使い、8~100字で入力してください。">
                </li>
                <li class="list-group-item">
                    <label for="password_confirm">パスワード(※確認用)</label>
                    <input type="password" name="password" placeholder="入力したパスワードと同じものを入力してください。">
                </li>
                </ul>
            </div>
            </div>

            <div id="user-prof" class="card" style="margin: 10.0rem 0;">
            <div class="card-header">プロフィール登録</div>
            <div class="card-body text-secondary">
                <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <label for="user_name">ニックネーム</label>
                    <input type="text" name="user_name" placeholder="ニックネームを入力してください。">
                </li>
                <li id="birthday" class="list-group-item">
                    <label for="birthday">生年月日</label>
                    <input type="date">
                </li>
                <li id="sex" class="list-group-item">
                    <label for="sex">性別</label>
                    <select name="sex">
                        <option value=0>男性</option>
                        <option value=1>女性</option>
                        <option value=2>その他</option>
                    </select>
                </li>
                <li class="list-group-item">
                    <label for="former_job">以前のご職業</label>
                    <input type="text" name="former_job" placeholder="以前のお仕事を入力してください。">
                </li>
                <li class="list-group-item">
                    <label for="job">現在のご職業</label>
                    <input type="text" name="job" placeholder="現在のお仕事を入力してください。">
                </li>
                <li class="list-group-item">
                    <button type="button" class="btn btn-success" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                        この内容で登録する
                    </button>
                </li>
                </ul>
            </div>
            </div>

        </div>

    </div>

</div>
@endsection