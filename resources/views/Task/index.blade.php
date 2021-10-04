@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <div class="col-md-11 col-md-offset-1">
                            <table class="table text-center">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">タスク</th>
                                    <th class="text-center">ユーザー</th>
                                </tr>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        <a href="/home/{{ $task->id }}/edit">{{ $task->id }}</a>
                                    </td>
                                    <td>
                                        <a href="/home/task/{{$task ->id}}">{{ $task->task }}</a>
                                    </td>
                                    <td>{{ $task->User }}</td>
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
                            <div><a href="/home/create" class="btn btn-default">新規作成</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
