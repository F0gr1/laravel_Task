@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<div class="container ops-main">
    <div class="card-header bg-dark text-white text-center">myタスクにユーザーを追加</div>
    <div class="card-body">
        <div class="row  justify-content-center">
            <div class="col-md-8 p-4">
                <form action="/user/add/" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group d-flex">
                        <label for='name' class='col-md-3'>ユーザー</label>
                        <select name="userId"   class='form-control'>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"　name="user">{{ $user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex">
                        <label for='name' class='col-md-3'>タスク</label>
                        <select name="taskId"  class='form-control'>
                            @foreach($tasks as $task )
                                <option value="{{$task->id }}" name="task">{{ $task->task }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="d-flex">
                        <a href='/home' class='col-md-2 text-dark pt-2  offset-md-10' >戻る</a>
                        <button type="submit" class="btn btn-outline-secondary col-md-1">登録</button>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>
@endsection