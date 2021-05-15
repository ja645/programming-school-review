@extends('layouts.admin')

@section('title', 'edit-school')

@section('content')

@can('idAdmin')
<div class="container-xl">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">
        
        <form action="/admin/update" method="post" enctype="multipart/form-data">
        @if (count($errors) > 0)
        <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
        </ul>
        @endif
        @csrf
            <input type="hidden" name="id" value="$school->id">
            <div id="user-prof" class="card" style="margin: 10.0rem 0;">
            <div class="card-header">スクール登録</div>
            <div class="card-body text-secondary">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <label for="user_name">スクール名</label>
                      <input type="text" name="school_name" value="{{ old('school_name', $school->school_name) }}" placeholder="スクール名を入力してください。">
                  </li>
                  <li class="list-group-item">
                      <label for="user_name">スクールURL</label>
                      <input type="text" name="school_url" value="{{ old('school_url', $school->school_url) }}" placeholder="スクールの公式ページURLを入力してください。">
                  </li>
                  
                  <li class="list-group-item">
                      <label for="former_job">スクール住所</label>
                      <input type="text" name="address" value="{{ old('address', $school->address) }}" placeholder="スクールの住所を入力してください。">
                  </li>

                  <li class="list-group-item">
                      <label for="former_job">スクールの特徴</label>
                      <input type="text" name="features" value="{{ old('features', $school->features) }}" placeholder="スクールの特徴を入力してください。">
                  </li>

                  <li class="list-group-item">
                    <button type="submit" class="btn btn-success">
                        編集を完了する
                    </button>
                  </li>
                </ul>
            </div>
            </div>

        </form>
        </div>

    </div>

</div>
@else
<p>管理者のみ閲覧出来ます。</p>
@endcan

@endsection