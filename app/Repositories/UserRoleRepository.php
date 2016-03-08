<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use DB;
use Carbon\Carbon;


class UserRoleRepository
{

    /**
    * Access all methods and objects in Repository
    */
    public function __construct()
    {

    }

    /**
     * find User Role
     * @param userRoleId $userRoleId
     * @return UserRole
     */
    public function findUserRole($userRoleId)
    {
        return UserRole::find($userRoleId);
    }

    /**
     * find User Role
     * @param userRoleId $userRoleId
     * @return UserRole
     */
    public function findUserRoleByUserId($userId)
    {
        return UserRole::where('UserId', $userId)->get();
    }

    /**
     * Save User Role
     * @param userId $userId
     * @param roleId $roleId
     * @return UserRole|Bollean
     */
    public function saveUserRole($userId, $roleId)
    {
        $userRole = new UserRole();
        $userRole->UserId = $userId;
        $userRole->RoleId = $roleId;

        if ($userRole->save()) {
            return $userRole;
        }
        return false;
    }

    /**
     *  Delete User Role by Role
     * @param RoleId $RoleId
     * @return Bollean
     */
    public function deleteUserRoleByRoleId($roleId)
    {
        // Delete User Role by Role
        return UserRole::where('RoleId', $roleId)->delete();
    }

    /**
     *  Delete User Role by User
     * @param UserId $userId
     * @return Bollean
     */
    public function deleteUserRoleByUserId($userId)
    {
        return UserRole::where('UserId', $userId)->delete();
    }

    /**
     * Getting User Role lists
     */
    public function all()
    {
        return UserRole::all();
    }

    /**
     * Getting User Role lists
     */
    public function UserRoleList()
    {
        return UserRole::lists('UserId', 'RoleId');
    }

}
