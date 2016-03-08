<?php
namespace App\Http\Controllers;


use App\Models\User;

use App\Models\Role;
use App\Models\UserRole;
use App\Models\Permission;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class AdminUsersController extends Controller
{
    /**
     * User Repository.
     *
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * Role Repository.
     *
     * @var RoleRepository
     */
    protected $roleRepo;

    /**
     * Permission Repository.
     *
     * @var PermissionRepository
     */
    protected $permissionRepo;

    /**
     * UserRole Repository.
     *
     * @var UserRoleRepository
     */
    protected $userRoleRepo;

    /**
     * Inject the models.
     *
     * @param UserRepository       $userRepo
     * @param RoleRepository       $roleRepo
     * @param PermissionRepository $roleRepo
     * @param UserRoleRepository   $userRoleRepo
     */
    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo,
            PermissionRepository $permissionRepo,UserRoleRepository $userRoleRepo)
    {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
        $this->userRoleRepo = $userRoleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Title
        $title = 'user_management';

        // Grab all the users
        $users = $this->userRepo->all();

        // Show the page
        return view('admin/users/index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $rolesAll = $this->roleRepo->all();
        $roles = array(''=>'Select');
        foreach($rolesAll as $role) {
            $roles[$role->RoleId] = $role->RoleName;
        }
        // Show the page
        return view('admin/users/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        try {
            $validator = \Validator::make(request()->all(), $this->userRepo->validationRules);
            $userData['name'] = Request::get('name');
            $userData['email'] = Request::get('email');
            $userData['password'] = Request::get('password');
            $userData['password_confirmation'] = Request::get('password_confirmation');
            $userData['role'] = Request::get('role');

            if (!$validator->fails()) {
                // Save if valid. Password field will be hashed before save
                $user = $this->userRepo->saveUser($userData);
            }
            if (isset($user)) {
                \Session::flash('success', 'User Created Successfully');
                // Redirect to the new user page
                return redirect()->route('admin.users.index');
            }
            return redirect('admin/users/create')
                ->withErrors($validator)
                ->withInput(request()->all());
        } catch (Exception $e) {
            return redirect('admin/users/create')
                ->withErrors($validator)
                ->withInput(request()->all());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $user
     *
     * @return Response
     */
    public function show($user)
    {
        $user = $this->userRepo->find($id);
        return view('admin/users/show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     *
     * @return Response
     */
    public function edit($id)
    {

        $user = $this->userRepo->find($id);
        $rolesAll = $this->roleRepo->all();
        $roles = array(''=>'Select');

        foreach($rolesAll as $role) {
            $roles[$role->RoleId] = $role->RoleName;
        }

        if ($user->id) {
            $userRole = $this->userRoleRepo->findUserRoleByUserId($user->id);
            $userRoleId = $userRole[0]->RoleId;
            return view('admin/users/edit', compact('user','roles','userRoleId'));
        }
        return redirect()->route('admin.users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     *
     * @return Response
     */
    public function update($id)
    {
        try {
            $validator = \Validator::make(request()->all(), $this->userRepo->editValidationRules($id));
            $userData['name'] = Request::get('name');
            $userData['email'] = Request::get('email');
            $userData['password'] = Request::get('password');
            $userData['password_confirmation'] = Request::get('password_confirmation');
            $userData['role'] = Request::get('role');

            if (!$validator->fails()) {
                // Save if valid. Password field will be hashed before save
                $user = $this->userRepo->updateUser($id, $userData);
            }
            if (isset($user)) {
                \Session::flash('success', 'User Updated Successfully');
                // Redirect to the new user page
                return redirect()->route('admin.users.index');
            }
            return redirect('admin/users/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(request()->all());
        } catch (Exception $e) {
            return redirect('admin/users/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(request()->all());
        }

    }

    /**
     * Remove user page.
     *
     * @param $user
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->userRepo->deleteUser($id);
            \Session::flash('success', 'User Delete Successfully');
            return redirect('admin/users/');
        } catch (Exception $e) {
            return redirect('admin/users/');

        }
    }

}
