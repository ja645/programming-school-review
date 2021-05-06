@extends('layouts.admin')

@section('title', 'contact')

@section('content')
<div class="container-xl">

  <div class="row d-flex justify-content-center">
    
    <div class="col-md-8">
      <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">
        <div class="card-header">お客様の情報を入力してください。</div>
        <div class="card-body text-secondary">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <label for="course">お名前を教えてください。</label>
                <input type="text" name="course" placeholder="受講したコース名を教えてください。">
            </li>
            <li class="list-group-item">
              <p>アカウントをお持ちの方はチェックしてください。</p>
              <form>
                <label><input type="radio" name="at_school" value="0">アカウントを持っている</label>
              </form>
            </li>
            <li class="list-group-item">
                <label for="course"></label>メールアドレスを入力してください。
                <input type="text" name="course" placeholder="受講したコース名を教えてください。">
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
              <input type="text" name="title">
            </li>                
            <li id="has-textarea" class="list-group-item">
              <label for="report">お問い合わせ内容</label>
              <textarea id="report" name="report"></textarea>
            </li>                
            <li class="list-group-item">
                <button type="button" class="btn btn-success" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                  送信
                </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
