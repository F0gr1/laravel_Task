@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table text-center ">
                            <tr>
                                <th class="text-center bg-dark text-white">プロジェクト</th>
                                <th class="text-center bg-dark text-white">ユーザー</th>
                                <th class="text-center bg-dark text-white">編集</th>
                                <th class="text-center bg-dark text-white">削除</th>
                            </tr>
                            @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <b><a href="/home/task/{{$task ->id}}" class="text-dark">{{ $task->task }}</a> </b>
                                </td>
                                <td class="text-dark">{{ $task->user }}</td>
                                <td>
                                    <a href="/home/{{ $task->id }}/edit" class="text-dark">
                                    <i class="far fa-edit p-2"></i>
                                    </a>
                                </td>
                                <td>
                                    <button type="button"
                                            class="btn btn-xs"
                                            aria-label="Left Align"
                                            onclick="alertAndDelete(
                                                '/home/{{ $task->id }}',
                                                'task',
                                                '{{csrf_token()}}')"
                                    >
                                    <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class= "offset-md-10">
                            <a href="/home/create" class="btn btn-outline-secondary">新規作成</a>
                        </div> 
                    </div>
                </div>
                <div class="d-flex justify-content-center text-dark ">{{ $tasks->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    </script>
