<?php

namespace App\Http\Controllers;

use Request;
use App\Models\RolesPermission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    /**
     * Instances of Permission  Repository
     */
    protected $permissionRepo;

    /**
    * Access all methods and objects in Repository
    */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissionRepo->all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
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
            $validator = \Validator::make(request()->all(), $this->permissionRepo->validationRules,
                ['AccessLevel.regex' => \Lang::get('validation.hyphenRegex')]);
            if (!$validator->fails()) {
                $role = $this->permissionRepo->savePermission(Request::get('AccessLevel'),
                    Request::get('ParentPermission') );
                \Session::flash('success', 'Permission Added Successfully');
                return redirect('admin/permissions/');
            }
            return redirect('admin/permissions/create')
                ->withErrors($validator)
                ->withInput(request()->all());
        } catch (Exception $e) {
            return redirect('admin/permissions/create')
                ->withErrors($validator)
                ->withInput(request()->all());
        }

//        Role::create($permissions);
       // return redirect('permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions = $this->permissionRepo->find($id);
        return view('admin.permissions.show', compact('permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepo->find($id);
        return view('admin.permissions.edit')
                    ->with('permission', $permission);
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
                $this->permissionRepo->editValidationRules($id),
                ['RoleName.regex' => \Lang::get('validation.hyphenRegex')]);

            if (!$validator->fails()) {
                $role = $this->permissionRepo->updatePermission($id, Request::get('AccessLevel'),
                        Request::get('ParentPermission'));
                \Session::flash('success', 'Role Updated Successfully');
                return redirect('admin/permissions');
            }
            return redirect('admin/permissions/'.$id.'/edit')
                ->withErrors($validator);
        } catch (Exception $e) {
            return redirect('admin/permissions/'.$id.'/edit')
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
        $this->permissionRepo->deletePermission($id);
        \Session::flash('success', 'Permissions Deleted Successfully');
        return redirect('admin/permissions');
    }
}
