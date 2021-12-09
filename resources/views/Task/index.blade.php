@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">
                        <table class="table text-center">
                            <tr>
                                <th class="text-center">プロジェクト</th>
                                <th class="text-center">ユーザー</th>
                                <th class="text-center">編集</th>
                                <th class="text-center">削除</th>
                            </tr>
                            @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <a href="/home/task/{{$task ->id}}">{{ $task->task }}</a>
                                </td>
                                <td>{{ $task->user }}</td>
                                <td>
                                    <a href="/home/{{ $task->id }}/edit">編集</a>
                                </td>
                                <td>
                                    <button type="button"
                                            class="btn btn-xs btn-danger"
                                            aria-label="Left Align"
                                            onclick="alertAndDelete(
                                                '/home/{{ $task->id }}',
                                                'task',
                                                '{{csrf_token()}}')"
                                    >
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class= "col-md-11  text-right">
                    <a href="/home/create" class="btn btn-outline-success">新規作成</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    </script>
