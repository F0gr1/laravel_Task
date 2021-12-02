@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">

<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>プロジェクト詳細</h2>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
            <label for="name">プロジェクト名</label>
            </div>
            <div class="col-lg-8">
                <label for="memo">内容</label>
                <th>{{ $Project->memo }}</th>
            </div> 
            <div class="form-group">
                <label for="memo">進捗具合</label>
                <th>{{$Project->progress}}</th> 
            </div> 
            <a href="/home/">戻る</a>
            <a href="/home/task/{{$Project->id}}/edit">編集</a>
        </div>
    </div>
</div>