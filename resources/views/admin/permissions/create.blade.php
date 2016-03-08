@extends('layouts.apptemplate')

@section('title')
    Permissions Management
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')
@include('layouts.validationAlert')
<div class="adminPanel">
@section('content')
    <h1>Create Permissions</h1>
    {!! Form::open(['url'=>'/admin/permissions']) !!}
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
        {!! Form::submit('Create',['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop