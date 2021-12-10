<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<div class="container ops-main">
    <div class="card">
        <div class="card-header bg-dark text-white text-center">
                プロジェクト
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 offset-md-1 p-4">
            @if($target == 'store')
                <form action="/home" method="post">
                @elseif($target == 'update')
                <form action="/home/{{ $task->id }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group d-flex">
                        <label for="task" class='col-md-3'>プロジェクト名</label>
                        <input type="text" class="form-control" name="task" value="{{ $task->task }}">
                    </div>
                    <div class="form-group d-flex pt-4 ">
                        <label for='name' class='col-md-3'>作成者</label>
                        <label class="form-control col-md-9 " name="User" > {{ $userName->name }}</label>
                        <input type='hidden' class="form-control " name="user" value="{{ $userName->name }}"/> 
                    </div>
                    <div class="d-flex">
                        <a href='/home' class='col-md-1 text-dark pt-2  offset-md-11 col-md-1' >戻る</a>
                        <button type="submit" class="btn btn-outline-secondary col-md-1">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>