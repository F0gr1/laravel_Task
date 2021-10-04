<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>書籍登録</h2>
        </div>
    </div>
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
                    <label for="name">タスク名</label>
                    <input type="text" class="form-control" name="task" value="{{ $task->task }}">
                </div>
                <div class="form-group">
                    <label for="User"> ユーザー</label>
                    <input type="text" class="form-control" name="User" value="{{ $task->User }}">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
                <a href="/home">戻る</a>
            </form>
        </div>
    </div>
</div>