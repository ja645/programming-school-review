@extends('layouts.admin')

@section('title', 'create-review')

@section('content')

  <div class="form-title">
    <h1>レビュー作成</h1>
  </div>
    
  <form action="/reviews/create" method="post" enctype="multipart/form-data">
  @if (count($errors) > 0)
  <ul>
  @foreach($errors->all() as $e)
  <li class="error-message">{{ $e }}</li>
  @endforeach
  </ul>
  @endif
  @csrf

    <p class="form-item">受講したスクールを教えてください。<br>(※ここにないスクールの場合は、お問い合わせください。)</p>
    <select name="school_id" class="feedback-input">
      @foreach($schools as $school)
        <option value="{{ $school->id }}" selected　@if(old('school_id') == $school->id) selected  @endif>{{ $school->school_name }}</option>
      @endforeach
    </select>

    <input type="text" name="course" class="feedback-input" value="{{ old('cource') }}" placeholder="受講したコース名を教えてください。">

    <p class="form-item">受講した時期</p>
    <input type="date" name="when_start" class="feedback-input" value="{{ old('when_start') }}">
    <p class="form-item">から</p>
    <input type="date" name="when_end" class="feedback-input" value="{{ old('when_end') }}">

    <input type="number" name="tuition" class="feedback-input" value="{{ old('tuition') }}" placeholder="受講料(半角英数字のみで入力)">

    <p class="form-item">受講した目的を教えてください。</p>
    <select name="purpose" class="feedback-input">
      <option value=0 selected @if(old('purpose') == 0) selected @endif>転職のため</option>
      <option value=1 @if(old('purpose') == 1) selected @endif>就職のため</option>
      <option value=2 @if(old('purpose') == 2) selected @endif>フリーランス志望</option>
      <option value=3 @if(old('purpose') == 3) selected @endif>学習自体が目的</option>
      <option value=4 @if(old('purpose') == 4) selected @endif>その他</option>
    </select>

    <p class="form-item">受講スタイルを教えてください。</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label for=""><input type="radio" name="at_school" value=0 @if(old('purpose') == 0) checked="true" @endif>オンライン</label>
      <label for=""><input type="radio" name="at_school" value=1 @if(old('purpose') == 1) checked="true" @endif>通学</label>
    </div>

    
    <p class="form-item">受講料に対する満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="st_tuition" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="st_tuition" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="st_tuition" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="st_tuition" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="st_tuition" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">受講期間に対する満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="st_term" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="st_term" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="st_term" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="st_term" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="st_term" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">教材に対する満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="st_curriculum" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="st_curriculum" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="st_curriculum" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="st_curriculum" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="st_curriculum" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">メンター(講師)に対する満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="st_mentor" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="st_mentor" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="st_mentor" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="st_mentor" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="st_mentor" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">転職支援などのサポートに対する満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="st_support" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="st_support" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="st_support" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="st_support" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="st_support" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">運営に対する満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="st_staff" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="st_staff" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="st_staff" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="st_staff" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="st_staff" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">総合的な満足度</p>
    <div class="feedback-input feedback-radio d-flex justify-content-between">
      <label>不満足</label>
      <label><input type="radio" name="total_judg" value=0 @if(old('purpose') == 0) checked="true" @endif>1</label>
      <label><input type="radio" name="total_judg" value=1 @if(old('purpose') == 1) checked="true" @endif>2</label>
      <label><input type="radio" name="total_judg" value=2 @if(old('purpose') == 2) checked="true" @endif>3</label>
      <label><input type="radio" name="total_judg" value=3 @if(old('purpose') == 3) checked="true" @endif>4</label>
      <label><input type="radio" name="total_judg" value=4 @if(old('purpose') == 4) checked="true" @endif>5</label>
      <label>満足</label>
    </div>

    <p class="form-item">スクールに対する率直な感想を教えてください。</p>
    <input type="text" name="title" class="feedback-input" value="{{ old('title') }}" placeholder="タイトル（20文字以内）">
    <textarea name="report" class="feedback-input" value="{{ old('report') }}" placeholder="レビュー本文（率直な印象をお聞かせください。）"></textarea>

    <input type="submit" value="投稿する"/>
  </form>
@endsection