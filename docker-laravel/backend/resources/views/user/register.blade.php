@extends('layouts.default')

@section('content')

    <h1>{{$page_name}}</h1>
    {{Form::open(['route' => 'user.store'])}}
    <div class="form-group">
        {{Form::label('name', '名前')}}
        @if($errors->has('name'))
            <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
        @endif
        {{Form::text('name', null, ['required', 'placeholder' => '名前', 'maxlength' =>'20', 'id' => 'name', 'class' => 'form-control'])}}
    </div>

    {{Form::label('text', '生年月日')}}
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

    {{Form::submit('登録', ['class' => 'my-5 btn btn-lg btn-primary btn-block'])}}

    {{Form::close()}}

    <a href="{{route('user.list')}}">
        <button class='my-5 btn btn-lg btn-primary btn-block'>一覧に戻る</button>
    </a>
@endsection
