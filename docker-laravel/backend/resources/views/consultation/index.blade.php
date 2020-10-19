@extends('layouts.default')

@section('content')

    <h1>{{$page_name}}</h1>

    {{Form::open(['route' => ['consultation.list'], 'method' => 'GET', 'id' => 'year'])}}
    {{Form::select('year', $years, $default, [ 'class' => 'form-control'])}}
    {{Form::close()}}
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">受診日</th>
            <th scope="col">受診したユーザー</th>
            <th scope="col">受診コース</th>
            <th scope="col">受診場所</th>
        </tr>
        </thead>
        <tbody>
        @if($list->count()===0)
            <tr>
                <th scope="row">受診記録が見つかりませんでした</th>
            </tr>
        @else
            @foreach($list as $item)

                <tr>
                    <td>{{\Carbon\Carbon::parse($item->consulted_at)->format('Y-m-d')}}</td>
                    <td>
                        <a href="{{route('user.detail', ['user'=>$item->users_id])}}">{{\App\Models\User::getName($item->users_id)}}</a>
                    </td>
                    <td>
                        @if($item->course ==1)
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
        <button class='my-5 btn btn-lg btn-primary btn-block'>ユーザー一覧を見る</button>
    </a>

    <script>
        $('select[name="year"]').change(function () {
            $('#year').submit();
        });
    </script>
@endsection

