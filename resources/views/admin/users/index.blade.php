@extends('layouts.apptemplate')

@section('title')
    Permissions Management
@endsection

@section('menu')
    @include('layouts.menu')
@endsection

@section('content')
@include('layouts.validationAlert')
<div class="adminPanel form-group NameRole rolesTable">
    <a href="{{url('admin/users/create')}}" class="btn btn-success"><i class="fa fa-plus-circle plus-icon"></i>&nbsp;&nbsp;&nbsp;Create User</a>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
				<th class="col-md-2">Name</th>
				<th class="col-md-2">Email</th>
				<th class="col-md-2">Role</th>
				<th class="col-md-2">Created Date</th>
				<th class="col-md-2">Actions</th>
			</tr>
			 @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->userRole->Role->RoleName}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                @if($user->id != \Config::get('vyoma-constants.super_admin_id'))
                   @can('Update User')
                    <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-default">Update</a>
                    @endcan
                     @can('Delete User')
                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.users.destroy', $user->id]]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-default']) !!}
                    {!! Form::close() !!}
                     @endcan
                @endif
                </td>
            </tr>
        @endforeach
		</thead>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript" src="assets/crud-app/js/serviceClient.js" />
  <script type="text/javascript" src="assets/crud-app/js/util.js" />
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
				oTable = $('#users').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/users/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}

			});
				/* Remove cancel arrow in create, edit, delete user  */
                $('#cboxClose').remove();
		});
	</script>
@stop
