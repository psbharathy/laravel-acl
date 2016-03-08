@extends('layouts.apptemplate')

@section('title')
    Permission Denied
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')
<div class="logo"></div>
<h3> {{$message}}</h3>
<a href="{{$url}}" class = "btn btn-success">Go Back to Home</a>
@endsection
