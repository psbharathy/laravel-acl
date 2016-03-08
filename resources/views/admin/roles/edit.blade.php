@extends('layouts.apptemplate')

@section('title')
    Role Management - Update
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')

<link rel="stylesheet" href="/assets/crud-app/css/custom.css" />
<div class="adminPanel">
@include('layouts.validationAlert')
    {!! Form::model($role,['method' => 'PATCH', 'route'=>['admin.roles.update',$role->RoleId]]) !!}
    <div class="form-group NameRole">
        {!! Form::label('role_name','Name:') !!}
        {!! Form::text('role_name', Input::old('role_name'),['class'=>'form-control']) !!}
    </div>
     <div class="rolesSelectBlock col-md-10 col-xs-12">
        <h4>Select applicable permissions</h4>
            @include('admin.roles.permissions', ['permissions' => $mypermissions,
                'permissionGroup' => $permissionGroup,
                'selectedpermission'=>$selectedpermission]
                )
        </div>

        <div class="form-group btn-create-role">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
</div>
@stop
