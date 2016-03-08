<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\User;

class UserRole extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'UserRole';

    protected $primaryKey = 'UserRoleId';
    // Disbale TimeStamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['UserId', 'RoleId'];

    /**
     * The roles that belong to the user.
     */
    public function userRole()
    {
        return $this->belongsTo('App\Models\User', 'UserId', 'id');
    }

    /**
     * The roles that belong to the user.
     */
    public function Role()
    {
        return $this->belongsTo('App\Models\Role', 'RoleId', 'RoleId');
    }

}
