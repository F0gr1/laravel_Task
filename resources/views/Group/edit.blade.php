@extends('layouts.app')
@section('content')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<div class="container ops-main">
    <div class="card">
        <div class="card-header bg-dark text-white text-center">グループ名</div>
        <div class="row　 justify-content-center">
            <div class="col-md-8  p-4">
                <form action="/home/group/update/{{ $group->id }}" method="post">
                    @csrf
                        <div class="form-group d-flex">
                            <label for="group" class='col-md-3'>グループ名</label>
                            <input type="text" class="form-control" name="group" value="{{ $group->group_name }}">
                        </div>
                        <div class="form-group d-flex">
                            <label for='name' class='col-md-3' >メンバー</label>
                            <select name="userId[]" class='form-control' multiple>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" name="user">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="d-flex"> 
                            <a href='/home' class='col-md-2 text-dark pt-2  offset-md-11 ' >戻る</a>
                            <button type="submit" class="btn btn-outline-secondary col-md-1">変更</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection