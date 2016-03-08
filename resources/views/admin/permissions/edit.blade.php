@extends('layouts.apptemplate')

@section('title')
    Role Management - Update
@endsection

@section('menu')
@include('layouts.menu')
@endsection

@section('content')
<div class="adminPanel">
@include('layouts.validationAlert')
    {!! Form::model($permission,['method' => 'PATCH','route'=>['admin.permissions.update',$permission->id]]) !!}
     <div class="form-group">
        {!! Form::label('parent_group','Parent Gruop:') !!}
        {!! Form::text('parent_group',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('permission','Permission:') !!}
        {!! Form::text('permission',null,['class'=>'form-control']) !!}
    </div>
     <div class="form-group">
        {!! Form::label('label','Label:') !!}
        {!! Form::text('label',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@stop