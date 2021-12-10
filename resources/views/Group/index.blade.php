@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">グループ</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <table class="table text-out-center">
                            <tr>
                                <th class="text-center">グループ</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>
                            @foreach($groups as $group)
                            <tr>
                                <th class = "text-center">{{$group->group_name}}</th>
                                <th class = "text-center">編集</th>
                                <!-- 編集画面へ移行するボタンの実装予定 -->
                                <td class = "text-center">
                                    <button type="button"
                                            class="btn btn-xs"
                                            aria-label="Left Align"
                                            onclick="alertAndDelete(
                                                '/group/{{$group->id}}',
                                                'group',
                                                '{{csrf_token()}}')"
                                    >
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </table>                       

                            <div>
                                <a href="/home/group/create" class="btn btn-outline-success">新規作成</a></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">{{ $groups->links() }}</div>
            </div>
        </div>
    </div>
</div>

@endsection

