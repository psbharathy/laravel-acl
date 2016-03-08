@extends('layouts.apptemplate')

@section('title')
    Role Management
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')

<div class="adminPanel form-group NameRole rolesTable">
    @include('layouts.validationAlert')
    <a href="{{url('admin/roles/create')}}" class="btn btn-success"><i class="fa fa-plus-circle plus-icon"></i>&nbsp;&nbsp;&nbsp;Create Role</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>Role Name</th>
            <th colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{$role -> role_name}}</td>
                <td>
                    @if($role -> role_name != \Config::get('acl-constants.super_admin_role_name'))
                        <a href="{{route('admin.roles.edit',$role->id)}}" class="btn btn-default">Update</a>
                        {!! Form::open(['method' => 'DELETE', 'route'=>['admin.roles.destroy', $role->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
