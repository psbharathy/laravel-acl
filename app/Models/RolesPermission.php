<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesPermission extends Model
{
    protected $table="RolePermission";

    protected $primaryKey = 'RolePermissionId';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['RoleId','PermissionId'];


}
