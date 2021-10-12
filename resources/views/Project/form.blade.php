<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>プロジェクト登録</h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
                <form action="/home/task/{$Task->id}}" method="post">
                @elseif($target == 'update')
                <form action="/home/task/{{$Project->id}}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">プロジェクト名</label>
                        <input type="text" class="form-control" name="project" value="{{ $Project->project }}">
                    </div>
                    @if($target == 'store')
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="taskId" value="{{ $Task->id}}">
                        </div>
                    @elseif ($target == 'update')
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="taskId" value="{{ $Project->taskId}}">
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="User">ユーザー</label>
                        <input type="text" class="form-control" name="User" value="{{ $Project->User }}">
                    </div>
                    <div class="form-group">
                        <label for="memo">概要</label>
                        <input type="text" class="form-control" name="memo" value="{{ $Project->memo }}">
                    </div>
                    <div class="form-group">
                    <label for="User">開始日</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $Project->start_date }}">
                    </div>
                    <div class="form-group">
                        <label for="User">終了日</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $Project->end_date }}">
                    </div>
                    <button type="submit" class="btn btn-default">登録</button>
                    <a href="/home/">戻る</a>
                </form>
            </div>
        </div>    
    </div>
</div>