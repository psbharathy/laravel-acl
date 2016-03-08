<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\UserRole;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The roles that belong to the user.
     */
    public function userRole()
    {
        return $this->hasOne('App\Models\UserRole');
    }

     /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function isSuperAdmin()
    {
        return ($this->roles[0]->attributes['role_id'] == \Config::get('acl-constants.super_admin_id'))?true:false;
    }

    /**
     * The roles that belong to the user.
     */
    public function hasRole($role)
    {
        if(is_string($role)) {

            return $this->roles->contains('role_name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function saveUserRole($user, $roleId)
    {
        $userRole = new UserRole;
        $userRole->user_id = $user;
        $userRole->role_id = $roleId;
        if($userRole->save()){
            return true;
        }
        return false;
    }
}
