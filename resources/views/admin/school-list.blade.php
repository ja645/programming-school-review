@extends('admin.layouts')

@section('title', 'school-list')

@section('content')
<div class="container-xl">
  <div>スクール一覧</div>

  @if($schools->isEmpty())
    <p class="is-empty">登録されたスクールはありません</p>
  @else

    <div class="review-list">
      @foreach ($schools as $school)
      <div class="list-group-item list-group-item-action d-flex justify-content-between">
        <a href="{{ url('/schools/' . $school->id) }}">
          {{ $school->school_name }}
        </a>
          <div class="d-flex">
            <a href="/admin/edit">編集</a>
            <form id="admin-delete" action="'/admin/delete" method="post">
            @csrf
              <a href="/admin/delete" onclick="event.preventDefault(); document.getElementById('admin-delete').submit();">削除</a>
            </form>
          </div>
      </div>
      @endforeach
    </div>
  @endif
</div>
@endsection