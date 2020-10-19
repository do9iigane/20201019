@extends('layouts.default')

@section('content')

    <h1>{{$page_name}}</h1>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <p class="float-right">名前</p>
            </div>
            <div class="col-sm">
                {{$user->name}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <p class="float-right">生年月日</p>
            </div>
            <div class="col-sm">
                {{\Carbon\Carbon::parse($user->birth)->format("Y年m月d日")}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <p class="float-right">年度年齢</p>
            </div>
            <div class="col-sm">
                {{$user->getAge($user->id)}}歳
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <p class="float-right">今年度の受診コース</p>
            </div>
            <div class="col-sm">
                {{$user->getCourse($user->id)}}
                @if($user->getAge($user->id)>=35)
                    1日人間ドック
                @else
                    基本健診
                @endif
            </div>
        </div>
    </div>

    <h2>受診記録一覧</h2>
    <a href="{{route('consultation.register', ['user' => $user->id])}}">
        <button class='btn btn-lg btn-primary btn-block'>受診記録登録</button>
    </a>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">受診年度</th>
            <th scope="col">受診日</th>
            <th scope="col">受診コース</th>
            <th scope="col">受診場所</th>
        </tr>
        </thead>
        <tbody>
        @if($user->consultations->count()===0)
            <tr>
                <th scope="row">受診記録が見つかりませんでした</th>
            </tr>
        @else
            @foreach($user->consultations as $item)

                <tr>
                    <th scope="row">{{\Carbon\Carbon::parse($item->consulted_at)->format('Y')}}</th>
                    <td>{{\Carbon\Carbon::parse($item->consulted_at)->format('Y-m-d')}}</td>
                    <td>
                        @if($item->course ===1)
                            1日人間ドック
                        @else
                            基本健診
                        @endif
                    </td>
                    <td>{{$item->place}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <a href="{{route('user.list')}}">
        <button class='my-5 btn btn-lg btn-primary btn-block'>ユーザー一覧に戻る</button>
    </a>
@endsection
