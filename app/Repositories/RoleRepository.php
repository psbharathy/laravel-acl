<?php
namespace App\Repositories;


use App\Models\Role;
use App\Models\RolesPermission;
use App\Models\Permission;
use App\Models\User;
use DB;
use Carbon\Carbon;

use App\Repositories\RolePermissionRepository;

class RoleRepository
{
    /**
    * Validation for assigning people to project and manager
    */
    public $validationRules = [
        'role_name' => 'required|unique:roles|regex:/(^[a-zA-Z\s]*-?[-a-zA-Z\s]*+$)+/'
      ];


    /**
    * Access all methods and objects in Repository
    */
    public function __construct( PermissionRepository $permissionRepo,
            RolePermissionRepository $rolePermissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
        $this->rolePermissionRepo = $rolePermissionRepo;
    }

    // Update validation rule
    public function editValidationRules($role)
    {
        $rules = array('role_name' => 'required|regex:/(^[a-zA-Z\s]*-?[-a-zA-Z\s]+$)+/|unique:roles,role_name,'.$role.',RoleId');
        return $rules;
    }

    public function findRole($roleId)
    {
        return Role::find($roleId);
    }

    /*
    * Insert row into Region table
    */
    public function saveRole($roleName, $permissions)
    {

        $role = new Role();
        $role->role_name = $roleName;

        if ($role->save()) {
            //Update Permissions
            $this->rolePermissionRepo->saveRolePermission($role->id, $permissions);

        }
        return $role;
    }

    public function updateRole($RoleId, $roleName, $permissions )
    {
        // Fetch Role
        $role = Role::find($RoleId);
        $role->role_name = $roleName;

        if($role->save())
        {
            // Delete All the exsiting role permissions
            $this->deleteRolePermissionsByRoleId($role->id);
            // Update with New permissions
            $this->rolePermissionRepo->saveRolePermission($role->id, $permissions);
            return $role;
        }
        return false;
    }

    public function deleteRolePermissionsByRoleId($RoleId)
    {
        // Delete Exsisting Permissions
        return RolesPermission::where('id', $RoleId)->delete();
    }

    public function deleteRole($RoleId)
    {
        // delete all permissions belong with roles
        $this->deleteRolePermissionsByRoleId($RoleId);
        return Role::find($RoleId)->delete();
    }

    /*
    * Getting Role lists
    */
    public function all()
    {
        $roles = Role::all();

        return $roles;
    }


    /*
    * Getting region lists
    */
    public function roleList()
    {
        $list = Role::lists('role_name', 'id');

        return $list;
    }



}
