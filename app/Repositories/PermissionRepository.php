<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\RolesPermission;
use App\Models\Permission;
use App\Models\User;
use DB;
use Carbon\Carbon;

class PermissionRepository
{
    /**
     * Validation for Permissions
     */
    public $validationRules = [
        'permission' => 'required|unique:Permissions|regex:/(^[a-zA-Z\s]*-?[-a-zA-Z\s]*+$)+/'
      ];

    // Update validation rule
    public function editValidationRules($permission)
    {
        $rules = array('permission' => 'required|regex:/(^[a-zA-Z\s]*-?[-a-zA-Z\s]+$)+/|unique:Permissions,permission,'.$role['permission'].',PermissionId');
        return $rules;
    }

    public function findPermission($permission)
    {
        return Permission::find($permission);
    }

    /*
    * Insert row into Region table
    */
    public function savePermission($permission, $ParentPermission)
    {

        $Permission = new Permission();
        $Permission->AccessLevel = $permission;
        $Permission->ParentPermission = $ParentPermission;

        if ($Permission->save()) {
            return $Permission;
        }
        return false;
    }

    public function updatePermission($permissionId, $permission, $ParentPermission )
    {
        // Fetch Permission
        $Permission = Permission::find($permissionId);
        $Permission->AccessLevel = $permission;
        $Permission->ParentPermission = $ParentPermission;

        if($Permission->save()) {
            return $Permission;
        }
        return false;
    }

    public function deleteRolePermissionsByPermissionId($permissionId)
    {
        // Delete Exsisting Permissions
        return RolesPermission::where('id', $permissionId)->delete();
    }

    public function deletePermission($permissionId)
    {
        // delete all role permissions belong with permissions
        $this->deleteRolePermissionsByPermissionId($permissionId);
        return Permission::find($permissionId)->delete();
    }

    /*
    * Getting Permission lists
    */
    public function all($isResponseInArray = false)
    {
        return ($isResponseInArray)?Permission::all()->toArray():Permission::all();
    }


    /*
    * Getting region lists
    */
    public function permissionList()
    {
        return Permission::lists('permission', 'id');
    }

}
