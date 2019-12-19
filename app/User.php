<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
    return $this->belongsToMany('App\Role');
}

    public function hasPermission($permissionRoute)
    {
        //dd($permissionRoute);
        foreach ($this->roles as $role) {
            if ($role->permissions->where('route', 'all')->first()!==Null||$role->permissions->where('route', $permissionRoute)->first()!==Null) {
                return true;
            }
        }

        return false;
    }
}
