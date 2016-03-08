<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\RolesPermission;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserRole;
use DB;
use Carbon\Carbon;

use App\Repositories\RolePermissionRepository;

class UserRepository
{

    /**
     * Instances of Role Repository
     */
    protected $roleRepo;

    /**
     * Instances of User Role Repository
     */
    protected $userRoleRepo;

    /**
    * Validation for assigning people to project and manager
    */
    public $validationRules = [
        'name' => 'required|regex:/(^[a-zA-Z\s]*-?[-a-zA-Z\s]*+$)+/',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_num|confirmed:password_confirmation',
        'role' => 'required|numeric'
    ];

    // Update validation rule
    public function editValidationRules($id)
    {
        $rules = array(
            'name' => 'required|regex:/(^[a-zA-Z\s]*-?[-a-zA-Z\s]*+$)+/',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'role' => 'required|numeric'
        );
        return $rules;
    }

    /**
    * Access all methods and objects in Repository
    */
    public function __construct( RoleRepository $roleRepo, UserRoleRepository $userRoleRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->userRoleRepo = $userRoleRepo;

    }

    public function find($userId)
    {
        return User::find($userId);
    }

    /**
     *  Save User
     * @param Array $userData
     * @return UserModel
     */
    public function saveUser($userData)
    {
        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];

        if (!empty($userData['password'])) {
            if ($userData['password'] === $userData['password_confirmation']) {
                $encrypt = (\Config::get('auth.encrypt_type'));
                $user->password = $encrypt($userData['password']);
            }
        }
        // User role save
        if ($user->save()) {
            $this->userRoleRepo->saveUserRole($user->id, $userData['role']);
            return $user;
        }
    }

    /**
     *  Update User
     * @param Integer $userId
     * @param Array $userData
     * @return UserModel
     */
    public function updateUser($userId, $userData)
    {
        // Fetch User
        $user = User::find($userId);
        $user->name = $userData['name'];
        $user->email = $userData['email'];

        if (!empty($userData['password'])) {
            if ($userData['password'] === $userData['password_confirmation']) {
                $encrypt = (\Config::get('auth.encrypt_type'));
                $user->password = $encrypt($userData['password']);
            }
        }
        if ($user->save()) {
            // Remove exsisting User rolemapping
            $this->userRoleRepo->deleteUserRoleByUserId($user->id);
            // Update User Role
            $this->userRoleRepo->saveUserRole($user->id, $userData['role']);
            return $user;
        }
    }

    /**
     *  Delete User
     * @param Integer $userId
     * @return Boolean
     */
    public function deleteUser($userId)
    {
        // delete all permissions belong with roles
        return User::find($userId)->delete();
    }

    /*
    * Getting all user lists
    */
    public function all()
    {
        return User::all();

    }

    /*
    * Getting user lists
    */
    public function UserList()
    {
        return  User::lists('email', 'id');

    }



}
