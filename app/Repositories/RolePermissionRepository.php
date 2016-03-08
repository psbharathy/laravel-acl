<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\RolesPermission;
use App\Models\Permission;
use App\Models\User;
use DB;
use Carbon\Carbon;

class RolePermissionRepository
{

    public function findPermission($permission)
    {
        return Permission::find($permission);
    }

    public function deleteRolePermissionsByRoleId($RoleId)
    {
        // Delete Exsisting Permissions
        return RolesPermission::where('RoleId', $RoleId)->delete();
    }

    public function deleteRolePermissionsByPermissionId($permissionId)
    {
        // Delete Exsisting Permissions
        return RolesPermission::where('PermissionId', $permissionId)->delete();
    }

    public function findByRoleId($roleId, $responseArray = false)
    {
       $rolePermissions = RolesPermission::where('RoleId',$roleId)
            ->lists('PermissionId');
       return (!$responseArray)?$rolePermissions:$rolePermissions->toArray();
    }

    public function saveRolePermission($roleId, $permissions)
    {
        if(is_array($permissions)) {
            foreach ($permissions as $permission ) {
                $rolePermission = new RolesPermission();
                $rolePermission->RoleId = $roleId;
                $rolePermission->PermissionId= $permission;
                $rolePermission->save();
            }
        return true;
        }
        return false;

    }

}
