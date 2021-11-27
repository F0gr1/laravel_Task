@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>Userを追加</h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <form action="/user/add/" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                    <select name="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach

                    <select name="job_id">
                    @foreach($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->task }}</option>
                    @endforeach
                    
                    <button type="submit" class="btn btn-default">登録</button>
                    <a href="/home/">戻る</a>
                </form>
            </div>
        </div>    
    </div>
</div>
@endsection