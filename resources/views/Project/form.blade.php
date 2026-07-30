<link href="{{ asset('css/main.css') }}" rel="stylesheet">

<div class="container ops-main">
        <div class="card-header bg-dark text-white text-center">
                タスク
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
            @if($target == 'store')
                <form action="{{ route('projects.store', ['task' => $Task]) }}" method="post">
                @elseif($target == 'update')
                <form action="{{ route('projects.update', ['project' => $Project]) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group d-flex">
                        <label for="name" class='col-md-3'>タスク名</label>
                        <input type="text" class="form-control" name="project" value="{{ $Project->project }}">
                    </div>
                    <!-- <div class="form-group">
                        <label for="User">ユーザー</label>
                        <input type="text" class="form-control" name="User" value="{{ $Project->User }}">
                    </div> -->
                    <div class="form-group d-flex">
                        <label for="PIC" class='col-md-3'>担当者</label>
                        <select name="PIC"   class='form-control' value="{{$Project -> PIC}}">
                            @foreach($users as $user)
                                <option value="{{$user->name}}" @selected($Project->PIC === $user->name)>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex">
                        <label for="memo" class='col-md-3'>内容</label>
                        <input type="text" class="form-control" name="memo" value="{{ $Project->memo }}">
                    </div>
                    <div class="form-group d-flex">
                        <label for="progress" class='col-md-3'>進捗具合</label>
                        <input type="number" class="form-control" name="progress" value="{{ $Project->progress }}"> 
                    </div>
                    <div class="form-group d-flex">
                    <label for="start_date" class='col-md-3'>開始日</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $Project->start_date }}">
                    </div>
                    <div class="form-group d-flex">
                        <label for="end_date" class='col-md-3'>終了日</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $Project->end_date }}">
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('home') }}" class='col-md-2 text-dark pt-2  offset-md-11'>戻る</a>
                        <button type="submit" class="btn btn-outline-secondary col-md-1">登録</button>
                    </div>
                </form>
            </div>
        </div>    
    </div>
</div>
