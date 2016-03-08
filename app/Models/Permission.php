<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Zizaco\Entrust\EntrustPermission;

class Permission extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Permissions';

    protected $primaryKey = 'PermissionId';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['AccessLevel'];


    /**
     * The permissions that belong to the roles.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'RolePermission', 'PermissionId', 'RoleId');
    }
}
