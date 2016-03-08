<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Request;
use App\Models\Role;
use App\Models\RolesPermission;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Role::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.users.create')
            ->with('mypermissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = Request::get('username');
        $user->description = Request::get('description');
        $perm = Request::get('permission');
        //dd($user);
        if ($user->save()) {

        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = Role::find($id);
        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Role::find($id);
        $permissions = Permission::all();
        $selected_permission = RolesPermission::where('RoleId',$id)->lists('PermissionId')->toArray();
        return view('admin.users.edit')
                    ->with('mypermissions',$permissions)
                    ->with('users', $users)
                    ->with('selectedpermission',$selected_permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $role->RoleName = Request::get('RoleName');
        $perm = Request::get('permission');

        if($role->save())
        {

        }
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect('admin/users');
    }
}
