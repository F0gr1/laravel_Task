@extends('layouts.app')
@section('content')
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>タスク名</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <form action="/home/{{ $task->id }}" method="post">
                <!-- updateメソッドにはPUTメソッドがルーティングされているのでPUTにする -->
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="Task">Task</label>
                    <input type="text" class="form-control" name="task" value="{{ $task->task }}">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="User" value="  {{Auth::user()->name }}">
                </div>
                
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/home">戻る</a>
            </form>
        </div>
    </div>
</div>
@endsection