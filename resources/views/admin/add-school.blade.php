@extends('admin.layouts')

@section('title', 'add-school')

@section('content')
<div class="container-xl">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">
        
        <form action="/admin/create" method="post" enctype="multipart/form-data">
        @if (count($errors) > 0)
        <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
        </ul>
        @endif
        @csrf
            <div id="user-prof" class="card" style="margin: 10.0rem 0;">
            <div class="card-header">スクール登録</div>
            <div class="card-body text-secondary">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                      <label for="user_name">スクール名</label>
                      <input type="text" name="school_name" value="{{ old('school_name') }}" placeholder="スクール名を入力してください。">
                  </li>
                  <li class="list-group-item">
                      <label for="user_name">スクールURL</label>
                      <input type="text" name="school_url" value="{{ old('school_url') }}" placeholder="スクールの公式ページURLを入力してください。">
                  </li>

                  <li class="list-group-item">
                      <label for="former_job">スクールの特徴</label>
                      <input type="text" name="features_[]" value="{{ old('features') }}" placeholder="スクールの特徴を入力してください。">
                      <a id="add" type="button" onclick="addInput()" style="margin-top: 20px;>特徴を追加&emsp;<i class="fas fa-plus fa-2x"></i></a>
                  </li>

                  <li class="list-group-item">
                    <button type="submit" class="btn btn-success">
                        この内容で登録する
                    </button>
                  </li>
                </ul>
            </div>
            </div>

        </form>
        </div>

    </div>

</div>

<script type="text/javascript">
    function addInput(){
        var add = document.getElementById('add');

        var new_input = document.createElement('input');
        new_input.setAttribute('type', 'text');
        new_input.setAttribute('name', 'features_[]');
        new_input.setAttribute('placeholder', 'スクールの特徴を入力してください。');

        add.before(new_input);
    };
</script>
@endsection