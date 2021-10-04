@extends('layouts.app')
@section('content')
@include('Task.form', ['target' => 'store'])
@endsection