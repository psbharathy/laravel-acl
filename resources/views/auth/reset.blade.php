@extends('layouts.apptemplate')

@section('title')
    Login
@endsection

@section('menu')
@include('layouts.staticHeader')
@endsection

@section('content')
<br><br>

  <div class="logo"></div>

<div class="login-block">
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="form-group">
        Email
        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        Password
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        Confirm Password
        <input type="password" class="form-control" name="password_confirmation">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">
            Reset Password
        </button>
    </div>
</form>

</div>
@stop
