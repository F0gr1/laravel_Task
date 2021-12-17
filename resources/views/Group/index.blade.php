@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <table class="table text-center">
                            <tr>
                                <th class="text-center bg-dark text-white">グループ</th>
                                <th class="text-center bg-dark text-white">人数</th>
                                <th class="text-center bg-dark text-white">編集</th>
                                <th class="text-center bg-dark text-white">削除</th>
                            </tr>
                            @foreach($groups as $group)
                            <tr>
                                <td class = "text-dark">{{$group->group_name}}</td>
                                <td class = "text-dark">{{$group->SUM}}</td>
                                <td>
                                    <a href="/home/group/edit/{{ $group->id }}" class="text-dark" >
                                        <i class="far fa-edit p-2"></i>
                                    </a>
                                </td>
                                <!-- 編集画面へ移行するボタンの実装予定 -->
                                <td>
                                    <button type="button"
                                            class="btn btn-xs"
                                            aria-label="Left Align"
                                            onclick="alertAndDelete(
                                                '/group/{{$group->id}}',
                                                'group',
                                                '{{csrf_token()}}')"
                                    >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            </table>                       
                            <div class= "offset-md-10">
                                <a href="/home/group/create" class="btn btn-outline-secondary">新規作成</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

