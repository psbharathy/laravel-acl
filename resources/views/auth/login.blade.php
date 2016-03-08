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

    <form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder ="Username">
    </div>

    <div class="form-group">
        Password
        <input type="password" class="form-control" name="password" id="password" placeholder ="Password">
    </div>

    <div class="form-group" align="right">
        <a href="{{  url('password/email') }}" >Forgot Password </a>
    </div>

    <div class="form-group">
        <button class="btn btn-default" type="submit">Login</button>
    </div>
</div>
</form>

</div>
@stop
