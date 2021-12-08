@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <tr>
                        <th>タスク</th>
                    <tr>
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
                                    <th class="text-center">タスク</th>
                                    <th class="text-center">ユーザー</th>
                                    <th class="text-center">Edit</th>
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
                                    <form action="/home/{{ $task->id }}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div>
                                <a href="/home/create" class="btn btn-outline-success">新規作成</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">{{ $tasks->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    </script>
