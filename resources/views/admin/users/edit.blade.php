@extends('layouts.apptemplate')

@section('title')
    Permissions Management
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')
@include('layouts.validationAlert')
<div class="adminPanel form-group NameRole usersTable">


	{!! Form::model($user,['method' => 'PATCH', 'route'=>['admin.users.update',$user->id]]) !!}
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->
		    <div class="form-group">
				<!-- username -->
			<div class="form-group col-md-6 col-xs-12">
        {!! Form::label('Name','Name:') !!}
        {!! Form::text('name', null,['class'=>'form-control']) !!}
    	</div>
				<!-- ./ username -->
			<div class="form-group col-md-6 col-xs-12">
        {!! Form::label('email','Email:') !!}
        {!! Form::text('email', null,['class'=>'form-control']) !!}
    	</div>
				<!-- ./ email -->

				<!-- Password -->
			<div class="form-group col-md-6 col-xs-12">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password', null,['class'=>'form-control']) !!}
    	</div>
				<!-- ./ password -->
				<!-- Password Confirm -->
			<div class="form-group col-md-6 col-xs-12">
        {!! Form::label('password_confirmation','Confirm Password:') !!}
        {!! Form::password('password_confirmation', null,['class'=>'form-control']) !!}
    	</div>
				<!-- ./ password confirm -->
					<!-- Role -->
			<div class="form-group col-md-6 col-xs-12">
        {!! Form::label('Role','Role:') !!}
        {!! Form::select('role', $roles, $userRoleId, ['class'=>'form-control']) !!}
    	</div>
				<!-- ./ Role-->
		<div class="form-group col-md-8 col-xs-12">
        {!! Form::submit('Save', ['class' => 'col-md-9 col-xs-12 btn btn-primary']) !!}
    </div>
		<!-- ./ form actions -->
@stop
