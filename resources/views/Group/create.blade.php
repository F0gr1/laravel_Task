@extends('layouts.app')
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<div class="container ops-main">
    <div class="card">
        <div class="card-header">グループ名</div>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <form action="/home/group/store" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="group">グループ名</label>
                            <input type="text" class="form-control" name="group">
                        </div>
                        <div class="form-group">
                            <label for='name'>メンバー</label>
                            <select name="userId[]" class='form-control' multiple>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" name="user">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">登録</button>
                        <a href="/home">戻る</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection