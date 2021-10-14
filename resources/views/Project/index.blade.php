@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">プロジェクト</div>

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
                                    <th class="text-center">ID</th>
                                    <th class="text-center">プロジェクト</th>
                                    <th class="text-center">ユーザー</th>
                                    <th class="text-center">メモ</th>
                                    <th class="text-center">期間</th>
                                    <th class="text-center">削除</th>
                                </tr>
                                @foreach($Projects as $Project)
                                <tr>
                                    <td>
                                        <a href="/home/task/{{ $Project->id }}/edit">{{ $Project->id }}</a>
                                    </td>
                                    <td>{{ $Project->project }}</td>
                                    <td>{{ $Project->User }}</td>
                                    <td>{{$Project->memo}}</td>
                                    <td>{{ $Project->start_date }}　〜　{{ $Project->end_date }}</td>
                                    <td>    
                                    <form action="/home/task/project/{{ $Project->id }}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div><a href="/home/task/project/create/{{$Task -> id}}" class="btn btn-default">新規作成</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    </script>
