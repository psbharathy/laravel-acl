<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Repositories\RoleRepository;
use App\Http\Controllers\Controller;
use App\Repositories\RolePermissionRepository;
use App\Repositories\PermissionRepository;


class RoleController extends Controller
{

    /**
     * Instances of Role Repository
     */
    protected $roleRepo;

    /**
     * Instances of RolePermission  Repository
     */
    protected $rolePermissionRepo;

    /**
     * Instances of Permission  Repository
     */
    protected $permissionRepo;

    /**
    * Access all methods and objects in Repository
    */
    public function __construct(RoleRepository $roleRepo,
        RolePermissionRepository $rolePermissionRepo, PermissionRepository $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->rolePermissionRepo = $rolePermissionRepo;
        $this->permissionRepo = $permissionRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepo->all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionRepo->all(true);
        $permissionGroup =  array_unique(array_column($permissions, 'ParentPermission'));

        $selectedpermission = Request::get('permissions');
        $selectedpermission = (is_array($selectedpermission))?:array();

        return view('admin.roles.create')->with('permissions', $permissions)
            ->with('permissionGroup', $permissionGroup)
            ->with('selectedpermission', $selectedpermission);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = \Validator::make(request()->all(), $this->roleRepo->validationRules,  ['RoleName.regex' => \Lang::get('validation.hyphenRegex')]);
            if (!$validator->fails()) {
                $role = $this->roleRepo->saveRole(Request::get('RoleName'), Request::get('permissions') );
                \Session::flash('success', 'Role Added Successfully');
                return redirect('admin/roles/');
            }
            return redirect('admin/roles/create')
                ->withErrors($validator)
                ->withInput(request()->all());
        } catch (Exception $e) {
            return redirect('admin/roles/create')
                ->withErrors($validator)
                ->withInput('RoleName', $request->get('RoleName'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepo->findRole($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepo->findRole($id);
        $permissions = $this->permissionRepo->all(true);

        $permissionGroup =  array_unique(array_column($permissions, 'ParentPermission'));
        $selectedPermission = $this->rolePermissionRepo->findByRoleId($id, true);

        return view('admin.roles.edit')
                    ->with('mypermissions',$permissions)
                    ->with('permissionGroup',$permissionGroup)
                    ->with('role', $role)
                    ->with('selectedpermission',$selectedPermission);
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
        try {
            $validator = \Validator::make(request()->all(),
                $this->roleRepo->editValidationRules($id),
                ['RoleName.regex' => \Lang::get('validation.hyphenRegex')]);

            if (!$validator->fails()) {
                $role = $this->roleRepo->updateRole($id, Request::get('RoleName'),
                        Request::get('permissions'));
                \Session::flash('success', 'Role Updated Successfully');
                return redirect('admin/roles');
            }
            return redirect('admin/roles/'.$id.'/edit')
                ->withErrors($validator);
        } catch (Exception $e) {
            return redirect('admin/roles/'.$id.'/edit')
                ->withErrors($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepo->deleteRole($id);
        \Session::flash('success', 'Role deleted Successfully');
        return redirect('admin/roles');
    }
}
