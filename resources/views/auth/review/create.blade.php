@extends('layouts.admin')

@section('title', 'create-review')

@section('content')
<div class="container-xl">

  <div class="row d-flex justify-content-center">
    
    <div class="col-md-8">
      <div id="user-info" class="card p-0" style="margin-top: 6.0rem;">
        <div class="card-header">受講したスクールの情報を入力してください。</div>
        <div class="card-body text-secondary">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <label class="label-school-name" for="school_name">受講したスクールを教えてください。<br>(※ここにないスクールの場合は、お問い合わせください。)</label>
                <select class="select-school-name" name="school_name" id="">
                  <option value=1>Tech::hogehoge</option>
                  <option value=1>Tech::hogehoge</option>
                  <option value=1>Tech::hogehoge</option>
                  <option value=1>Tech::hogehoge</option>
                  <option value=1>Tech::hogehoge</option>
                  <option value=1>Tech::hogehoge</option>
                </select>
            </li>
            <li class="list-group-item">
                <label for="course">受講したコース名</label>
                <input type="text" name="course" placeholder="受講したコース名を教えてください。">
            </li>
            <li class="list-group-item">
                <label for="term">受講した時期</label>
                <div class="row d-flex justify-content-between">
                  <div class="col-5">
                    <input class="input-term" type="month" name="term-s">
                  </div>
                  <div class="col" style="margin-top: 20px;">から</div>
                  <div class="col-5">
                    <input class="input-term" type="month" name="term-e">
                  </div>
                </div>
            </li>
            <li class="list-group-item">
              <label for="tuition">受講料を教えてください。(半角英数字のみで入力)</label>
              <input type="number" name="tuition">
            </li>
            <li class="list-group-item">
              <label class="label-purpose" for="purpose">受講した目的を教えてください。</label>
              <select class="select-purpose" name="purpose">
                <option value="0">転職のため</option>
                <option value="1">就職のため</option>
                <option value="2">フリーランス志望</option>
                <option value="3">学習自体が目的</option>
                <option value="4">その他</option>
              </select>
            </li>
            <li class="list-group-item">
              <p>受講スタイルを教えてください。</p>
              <form>
                <label><input type="radio" name="at_school" value="0">オンライン</label>
                <label class="at_school"><input type="radio" name="at_school" value="1">通学</label>
              </form>
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
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="st_tuition" value=1>1</label>
                <label><input type="radio" name="st_tuition" value=2>2</label>
                <label><input type="radio" name="st_tuition" value=3>3</label>
                <label><input type="radio" name="st_tuition" value=4>4</label>
                <label><input type="radio" name="st_tuition" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
            </li>
            <li class="list-group-item">
              <p>受講期間に対する満足度</p>
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="st_term" value=1>1</label>
                <label><input type="radio" name="st_term" value=2>2</label>
                <label><input type="radio" name="st_term" value=3>3</label>
                <label><input type="radio" name="st_term" value=4>4</label>
                <label><input type="radio" name="st_term" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
            </li>
            <li class="list-group-item">
              <p>教材に対する満足度</p>
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="st_curriculum" value=1>1</label>
                <label><input type="radio" name="st_curriculum" value=2>2</label>
                <label><input type="radio" name="st_curriculum" value=3>3</label>
                <label><input type="radio" name="st_curriculum" value=4>4</label>
                <label><input type="radio" name="st_curriculum" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
            </li>
            <li class="list-group-item">
              <p>メンター(講師)に対する満足度</p>
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="st_mentor" value=1>1</label>
                <label><input type="radio" name="st_mentor" value=2>2</label>
                <label><input type="radio" name="st_mentor" value=3>3</label>
                <label><input type="radio" name="st_mentor" value=4>4</label>
                <label><input type="radio" name="st_mentor" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
            </li>
            <li class="list-group-item">
              <p>転職支援などのサポートに対する満足度</p>
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="st_support" value=1>1</label>
                <label><input type="radio" name="st_support" value=2>2</label>
                <label><input type="radio" name="st_support" value=3>3</label>
                <label><input type="radio" name="st_support" value=4>4</label>
                <label><input type="radio" name="st_support" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
            </li>
            <li class="list-group-item">
              <p>運営に対する満足度</p>
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="st_staff" value=1>1</label>
                <label><input type="radio" name="st_staff" value=2>2</label>
                <label><input type="radio" name="st_staff" value=3>3</label>
                <label><input type="radio" name="st_staff" value=4>4</label>
                <label><input type="radio" name="st_staff" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
            </li>
            <li class="list-group-item">
              <p>総合的な満足度</p>
              <form class="satisfaction">
                <label class="label-satisfaction">不満足</label>
                <label><input type="radio" name="total_judg" value=1>1</label>
                <label><input type="radio" name="total_judg" value=2>2</label>
                <label><input type="radio" name="total_judg" value=3>3</label>
                <label><input type="radio" name="total_judg" value=4>4</label>
                <label><input type="radio" name="total_judg" value=5>5</label>
                <label class="label-satisfaction">満足</label>
              </form>
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
              <input type="text" name="title">
            </li>                
            <li id="has-textarea" class="list-group-item">
              <label for="report">レビュー本文(100字以上でご入力ください。)</label>
              <textarea id="report" name="report">率直な印象をお聞かせください。</textarea>
            </li>                
            <li class="list-group-item">
                <button type="button" class="btn btn-success" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                  レビューを作成する
                </button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
