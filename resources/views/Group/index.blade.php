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
                            <table class="table text-center">
                                <tr>
                                    <th class="text-center">グループ</th>
                                    <th class="text-center">編集</th>
                                    <th class="text-center">削除</th>
                                </tr>
                                @foreach($groups as $group)
                            <tr>
                                <th>{{$group->group_name}}</th>
                                <th>編集</th>
                                <td>
                                    <form action="/home/group{{$group->$id}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

