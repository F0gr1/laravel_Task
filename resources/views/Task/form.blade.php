<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<div class="container ops-main">
    <div class="card">
        <div class="card-header">タスク名</div>
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                @if($target == 'store')
                    <form action="/home" method="post">
                    @elseif($target == 'update')
                    <form action="/home/{{ $task->id }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                    @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="task">タスク名</label>
                            <input type="text" class="form-control" name="task" value="{{ $task->task }}">
                        </div>
                        <div class="form-group">
                            <label for='name'>作成者</label>
                            <label class="form-control" name="User" > {{ $userName->name }}</label>
                            <input type='hidden' class="form-control" name="User" value="{{ $userName->name }}"/> 
                        </div>
                        <button type="submit" class="btn btn-default">登録</button>
                        <a href="/home">戻る</a>
                    </form>
                </div>
            </div>
    </div>
</div>