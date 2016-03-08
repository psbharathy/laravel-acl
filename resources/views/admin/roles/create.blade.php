@extends('layouts.apptemplate')

@section('title')
    Role Management
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')
    <!-- custom CSS -->
    <link rel="stylesheet" href="/assets/crud-app/css/custom.css" />

@include('layouts.validationAlert')
<div class="col-md-1"></div>
  <div class="col-md-12">
<div class="adminPanel">
    {!! Form::open(['url'=>'admin/roles']) !!}
    <div class="form-group NameRole">
        {!! Form::label('role_name','Name:') !!}
        {!! Form::text('role_name', Input::old('role_name'), ['class'=>'form-control']) !!}
    </div>
    <div class="rolesSelectBlock col-md-10 col-xs-12">
        <h4> Select applicable permisions</h4>
        @include('admin.roles.permissions', ['permissions' => $permissions,
            'permissionGroup' => $permissionGroup,
            'selectedpermission'=> $selectedpermission])
    </div>
    <div class="form-group btn-create-role">
        {!! Form::submit('Create',['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    </div>
    </div>
@stop

</div>
