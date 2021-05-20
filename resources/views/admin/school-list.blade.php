@extends('admin.layouts')

@section('title', 'school-list')

@section('content')
<div id="top-container" class="container-fluid p-0" style="height: 100vh;">
  
  <div class="form-title">
    <h1>スクール一覧</h1>
  </div>

  <div class="row d-flex justify-content-center">

    <div class="col-md-8 col-10">
      @if($schools->isEmpty())
        <p class="is-empty">登録されたスクールはありません</p>
      @else
    </div>

    <div class="review-list col-md-8 col-10">
      @foreach ($schools as $school)
      <div class="list-group-item list-group-item-action d-flex justify-content-between">
        <a href="{{ url('/schools/' . $school->id) }}">
          {{ $school->school_name }}
        </a>
          <div class="d-flex">
            <form id="admin-edit" action="/admin/edit" method="post">
            @csrf
              <input type="hidden" name="id" value="{{ $school->id }}">
              <a href="/admin/edit" onclick="event.preventDefault(); document.getElementById('admin-edit').submit();">編集</a>
            </form>
            <form id="admin-delete" action="/admin/delete" method="post">
            @csrf
              <input type="hidden" name="id" value="{{ $school->id }}">
              <a href="/admin/delete" onclick="event.preventDefault(); document.getElementById('admin-delete').submit();">削除</a>
            </form>
          </div>
      </div>
      @endforeach
    </div>

    <nav aria-label="Page navigation example">
        {{ $schools->links() }}
    </nav>
    @endif

  </div>
</div>
@endsection