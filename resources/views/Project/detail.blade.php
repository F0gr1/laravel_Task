@extends('layouts.app')
@section('content')
<div class="container ops-main">
    <div class="card pd">
        <div class ="card-header bg-dark text-white text-center ">
            {{$Project->project}}
        </div>
        <div class = "card-body">
            <div class = "row align-items-center">
                <div class = "col-md-2 font-weight-bold">
                    <p>内容 :</p>
                </div>
                <div class = "col-md-10">
                    <p>{{ $Project->memo }}<p>
                </div>
            </div>
            <div class = "row">
                <dt class = "col-md-2">期間 :
                    <dd class ="col-md-2">{{$Project->start_date}}</dd>
                    <dd class ="px-2">---</dd>
                    <dd class = "col-md-2">{{$Project->end_date}}</dd>
                </dt>
            </div>
                <div class = "row">
                    <div class = "col-md-2 pt-3 font-weight-bold">
                        <p>進捗具合 :<p>
                    </div>
                    <div class = "pt-3">
                        <p>{{$Project->progress}}</p>
                    </div>
                </div>
            <div class = "row  justify-content-start">
                <div class  = "col-md-2">
                    <button type="button" onclick="history.back();" class="btn btn-outline-secondary">戻る</button>
                </div>
                <div class = "col-md-2">
                    <button type="button" onclick="location.href='/home/task/{{$Project->id}}/edit'" class="btn btn-outline-secondary">編集</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection