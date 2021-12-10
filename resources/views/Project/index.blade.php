@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-body">
                    <@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                <!-- </div>  -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table text-center">
                                <tr>
                                    <th class="text-center  bg-dark text-white">タスク</th>
                                    <th class="text-center  bg-dark text-white">担当者</th>
                                    <th class="text-center  bg-dark text-white">進捗</th>
                                    <th class="text-center  bg-dark text-white">期間</th>
                                    <th class="text-center  bg-dark text-white">編集</th>
                                    <th class="text-center  bg-dark text-white">削除</th>
                                </tr>
                                @foreach($Projects as $Project)
                                <tr>
                                        <td><a href="/home/task/{{ $Project->id }}/detail" class="text-dark">{{ $Project->project }}</a></td>
                                        <td class="text-dark">{{ $Project->PIC }}</td>
                                        <td class="text-dark">{{$Project->progress}}</td>
                                        <td class="text-dark">{{ $Project->start_date }}　〜　{{ $Project->end_date }}</td>
                                        <td>
                                        <a href="/home/task/{{ $Project->id }}/edit" class="text-dark" >
                                            <i class="far fa-edit p-2"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <button type="button"
                                                class="btn btn-xs btn-danger"
                                                aria-label="Left Align"
                                                onclick="alertAndDelete(
                                                    '/home/task/project/{{ $Project->id }}',
                                                    'project',
                                                    '{{csrf_token()}}')"
                                        >
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>

                                </tr>
                                @endforeach
                            </table>
                            <div class='offset-md-10'><a href="/home/task/project/create/{{$Task -> id}}" class="btn btn-outline-secondary">新規作成</a></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">{{ $Projects->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
