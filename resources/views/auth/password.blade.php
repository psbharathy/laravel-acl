@extends('layouts.apptemplate')

@section('title')
    Forgot Password
@endsection

@section('menu')
@include('layouts.staticHeader')
@endsection

@section('content')
<br><br>

  <div class="logo"></div>

<div class="login-block">
<form method="POST" action="/password/email">
    {!! csrf_field() !!}

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
        <button class="btn btn-default" type="submit">
            Send Password Reset Link
        </button>
    </div>
</form>
</div>
@stop
