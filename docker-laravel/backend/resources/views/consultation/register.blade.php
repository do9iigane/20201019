@extends('layouts.default')

@section('content')
    <h1>{{$page_name}}</h1>
    {{Form::open(['route' => ['consultation.store', 'user'=>$user->id]])}}

    {{Form::label('text', '受診日')}}
    @if($errors->has('year'))
        <div class="alert alert-danger" role="alert">{{ $errors->first('year') }}</div>
    @endif
    @if($errors->has('month'))
        <div class="alert alert-danger" role="alert">{{ $errors->first('month') }}</div>
    @endif
    @if($errors->has('day'))
        <div class="alert alert-danger" role="alert">{{ $errors->first('day') }}</div>
    @endif

    <div class="form-row">
        <div class="col-6">
            {{Form::number('year', null, ['required', 'length' => '4', 'min'=>'1900', 'max'=>'2020', 'placeholder' => '年', 'id' => 'year', 'class' => 'form-control'])}}
        </div>
        <div class="col">
            {{Form::number('month', null, ['required', 'length' => '2', 'min'=>'1', 'max'=>'12', 'placeholder' => '月', 'id' => 'month', 'class' => 'form-control'])}}
        </div>
        <div class="col">
            {{Form::number('day', null, ['required', 'length' => '2', 'min'=>'1', 'max' =>'31', 'placeholder' => '日', 'id' => 'day', 'class' => 'form-control'])}}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('course', '受診コース')}}
        @if($errors->has('course'))
            <div class="alert alert-danger" role="alert">{{ $errors->first('course') }}</div>
        @endif
        {{Form::select('course', ['1' => '1日人間ドック', '0' => '基本検診'], $default, [ 'class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('place', '受診場所')}}
        @if($errors->has('place'))
            <div class="alert alert-danger" role="alert">{{ $errors->first('place') }}</div>
        @endif
        {{Form::text('place', null, ['required', 'placeholder' => '受診場所', 'maxlength' =>'100', 'id' => 'place', 'class' => 'form-control'])}}
    </div>

    {{Form::submit('登録', ['class' => 'my-5 btn btn-lg btn-primary btn-block'])}}

    {{Form::close()}}

    <a href="{{route('user.detail', $user->id)}}">
        <button class='my-5 btn btn-lg btn-primary btn-block'>ユーザー詳細に戻る</button>
    </a>
@endsection
