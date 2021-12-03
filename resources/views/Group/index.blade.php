@extends('layouts.app')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">グループ</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <table class="table text-center">
                                <tr>
                                    <th class="text-center">グループ</th>
                                    <th class="text-center">編集</th>
                                    <th class="text-center">削除</th>
                                </tr>
                                    </form>
                                    </td>
                                </tr>
                            
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

