@extends('layouts.apptemplate')

@section('title')
    Permissions Management
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')
@include('layouts.validationAlert')
<div class="col-md-1"></div>
  <div class="col-md-8">
<div class="adminPanel">
    <hr>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>Id</th>
            <th>Parent</th>
            <th>Permission</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->parent_group}}</td>
                <td>{{$permission->permission}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@stop
