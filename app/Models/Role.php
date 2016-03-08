<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Roles';

    protected $primaryKey = 'RoleId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['RoleName'];

    /**
     * The roles that belong to the user.
     */
    public function userRole()
    {
        return $this->hasMany('App\Models\UserRole', 'RoleId', 'RoleId');
    }

     public function users()
    {
        return $this->belongsToMany('App\Models\User', 'UserRole', 'RoleId', 'UserId');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'RolePermission', 'RoleId', 'PermissionId');
    }
}
