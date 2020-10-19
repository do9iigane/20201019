@extends('layouts.default')

@section('content')

    <h1>{{$page_name}}</h1>
    <a href="{{route('user.register')}}">
        <button class='btn btn-lg btn-primary btn-block'>ユーザー登録</button>
    </a>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ユーザーID</th>
            <th scope="col">名前</th>
            <th scope="col">年度年齢</th>
            <th scope="col">今年度の受診コース</th>
            <th scope="col">受信回数</th>
        </tr>
        </thead>
        <tbody>
        @if($list->count()===0)
            <tr>
                <th scope="row">ユーザーが見つかりませんでした</th>
            </tr>
        @else
            @foreach($list as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td><a href="{{route('user.detail', ['user' => $user->id])}}">{{$user->name}}</a></td>
                <td>{{$user->getAge($user->id)}}歳</td>
                <td>
                    @if($user->getAge($user->id)>=35)
                        1日人間ドック
                    @else
                        基本健診
                    @endif
                </td>
                <td>{{count($user->consultations)}}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <a href="{{route('consultation.list')}}">
        <button class='my-5 btn btn-lg btn-primary btn-block'>受診記録一覧を見る</button>
    </a>
@endsection
