@extends('layouts.admin')

@section('title', 'create-review')

@section('content')
<div class="container-xl">

  <div class="row d-flex justify-content-center">
    <div class="col-md-8">
      <form action="/reviews/create" method="post" enctype="multipart/form-data">
      @if (count($errors) > 0)
      <ul>
      @foreach($errors->all() as $e)
      <li>{{ $e }}</li>
      @endforeach
      </ul>
      @endif
      @csrf
        <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">

          <div class="card-header">受講したスクールの情報を入力してください。</div>

          <div class="card-body text-secondary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                  <label class="label-school-name" for="school_id">受講したスクールを教えてください。<br>(※ここにないスクールの場合は、お問い合わせください。)</label>
                  <select class="select-school-name" name="school_id">
                    <option value=1 selected　@if(old('school_id') == 1) selected  @endif>Tech::hogehoge</option>
                    <option value=2 @if(old('school_name') == 2) selected  @endif>Tech::hogehoge</option>
                    <option value=3 @if(old('school_name') == 3) selected  @endif>Tech::hogehoge</option>
                    <option value=4 @if(old('school_name') == 4) selected  @endif>Tech::hogehoge</option>
                    <option value=5 @if(old('school_name') == 5) selected  @endif>Tech::hogehoge</option>
                    <option value=6 @if(old('school_name') == 6) selected  @endif>Tech::hogehoge</option>
                  </select>
              </li>
              <li class="list-group-item">
                  <label for="course">受講したコース名</label>
                  <input type="text" name="course" value="{{ old('cource') }}" placeholder="受講したコース名を教えてください。">
              </li>
              <li class="list-group-item">
                  <label for="term">受講した時期</label>
                  <div class="row d-flex justify-content-between">
                    <div class="col-5">
                      <input class="input-term" type="month" name="when_start" value="{{ old('when_start') }}">
                    </div>
                    <div class="col" style="margin-top: 20px;">から</div>
                    <div class="col-5">
                      <input class="input-term" type="month" name="when_end" value="{{ old('when_end') }}">
                    </div>
                  </div>
              </li>
              <li class="list-group-item">
                <label for="tuition">受講料を教えてください。(半角英数字のみで入力)</label>
                <input type="number" name="tuition" value="{{ old('tuition') }}">
              </li>
              <li class="list-group-item">
                <label class="label-purpose" for="purpose">受講した目的を教えてください。</label>
                <select class="select-purpose" name="purpose">
                  <option value=0 selected @if(old('purpose') == 0) selected @endif>転職のため</option>
                  <option value=1 @if(old('purpose') == 1) selected @endif>就職のため</option>
                  <option value=2 @if(old('purpose') == 2) selected @endif>フリーランス志望</option>
                  <option value=3 @if(old('purpose') == 3) selected @endif>学習自体が目的</option>
                  <option value=4 @if(old('purpose') == 4) selected @endif>その他</option>
                </select>
              </li>
              <li class="list-group-item">
                <p>受講スタイルを教えてください。</p>
                <div>
                  <label><input type="radio" name="at_school" value=0 @if(old('purpose') === 0) checked="true" @endif>オンライン</label>
                  <label class="at_school"><input type="radio" name="at_school" value=1 @if(old('purpose') === 1) checked="true" @endif>通学</label>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div id="user-info" class="card" style="margin: 10.0rem 0;">
          <div class="card-header">各項目の満足度を教えてください。</div>
          <div class="card-body text-secondary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <p>受講料に対する満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="st_tuition" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="st_tuition" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="st_tuition" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="st_tuition" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="st_tuition" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
              <li class="list-group-item">
                <p>受講期間に対する満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="st_term" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="st_term" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="st_term" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="st_term" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="st_term" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
              <li class="list-group-item">
                <p>教材に対する満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="st_curriculum" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="st_curriculum" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="st_curriculum" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="st_curriculum" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="st_curriculum" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
              <li class="list-group-item">
                <p>メンター(講師)に対する満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="st_mentor" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="st_mentor" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="st_mentor" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="st_mentor" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="st_mentor" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
              <li class="list-group-item">
                <p>転職支援などのサポートに対する満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="st_support" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="st_support" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="st_support" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="st_support" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="st_support" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
              <li class="list-group-item">
                <p>運営に対する満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="st_staff" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="st_staff" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="st_staff" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="st_staff" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="st_staff" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
              <li class="list-group-item">
                <p>総合的な満足度</p>
                <div class="satisfaction">
                  <label class="label-satisfaction">不満足</label>
                  <label><input type="radio" name="total_judg" value=0 @if(old('purpose') === 0) checked="true" @endif>1</label>
                  <label><input type="radio" name="total_judg" value=1 @if(old('purpose') === 1) checked="true" @endif>2</label>
                  <label><input type="radio" name="total_judg" value=2 @if(old('purpose') === 2) checked="true" @endif>3</label>
                  <label><input type="radio" name="total_judg" value=3 @if(old('purpose') === 3) checked="true" @endif>4</label>
                  <label><input type="radio" name="total_judg" value=4 @if(old('purpose') === 4) checked="true" @endif>5</label>
                  <label class="label-satisfaction">満足</label>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div id="user-prof" class="card" style="margin: 10.0rem 0;">
          <div class="card-header">スクールに対する率直な感想を教えてください。</div>
          <div class="card-body text-secondary">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <label for="title">タイトル(20字以内でご入力ください。)</label>
                <input type="text" name="title" value="{{ old('title') }}">
              </li>                
              <li id="has-textarea" class="list-group-item">
                <label for="report">レビュー本文(100字以上でご入力ください。)</label>
                <textarea id="report" name="report" value="{{ old('report') }}" placeholder="率直な印象をお聞かせください。"></textarea>
              </li>                
              <li class="list-group-item">
                <button type="submit" class="btn btn-success" data-bs-container="body">
                  レビューを作成する
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