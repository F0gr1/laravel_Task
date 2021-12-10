@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">タスク</div>

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
                            <table class="table text-center">
                                <tr>
                                    <th class="text-center">タスク</th>
                                    <th class="text-center">担当者</th>
                                    <th class="text-center">進捗</th>
                                    <th class="text-center">期間</th>
                                    <th class="text-center">編集</th>
                                    <th class="text-center">削除</th>
                                </tr>
                                @foreach($Projects as $Project)
                                <tr>
                                        <td><a href="/home/task/{{ $Project->id }}/detail">{{ $Project->project }}</a></td>
                                        <td>{{ $Project->PIC }}</td>
                                        <td>{{$Project->progress}}</td>
                                        <td>{{ $Project->start_date }}　〜　{{ $Project->end_date }}</td>
                                        <td>
                                        <a href="/home/task/{{ $Project->id }}/edit">編集</a>
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-xs btn-danger"
                                                aria-label="Left Align"
                                                onclick="alertAndDelete(
                                                    '/home/task/project/{{ $Project->id }}',
                                                    'project',
                                                    '{{csrf_token()}}')"
                                        >
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div><a href="/home/task/project/create/{{$Task -> id}}" class="btn btn-default">新規作成</a></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">{{ $Projects->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
