@extends('admin.layouts')

@section('title', 'add-school')

@section('content')        
<div id="top-container" class="container-fluid p-0">

    <div name="logo">
        <a href="/">
            ロゴ
        </a>
    </div>
    
    <div class="form-title">
        <p>スクール登録</p>
    </div>
    
    <form action="/admin/create" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
    <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
    @endif
    @csrf
    
        <input name="school_name" type="text" class="feedback-input" value="{{ old('school_name') }}" placeholder="スクール名"/>
        <input name="school_url" type="text" class="feedback-input" value="{{ old('school_url') }}" placeholder="公式ページのURL" />
        <input name="features[]" type="text" class="feedback-input" value="{{ old('features') }}" placeholder="スクールの特徴" />
        <a id="add" type="button" class="feedback-input add-input" onclick="addInput()"><i class="fas fa-plus fa-2x"></i></a>
        <input type="submit" value="登録"/>
    </form>
</div>

<script type="text/javascript">
    function addInput(){
        var add = document.getElementById('add');
        
        var new_input = document.createElement('input');
        new_input.setAttribute('type', 'text');
        new_input.setAttribute('name', 'features[]');
        new_input.setAttribute('class', 'feedback-input');
        new_input.setAttribute('placeholder', 'スクールの特徴を入力してください。');
        
        add.before(new_input);
    };
</script>
@endsection