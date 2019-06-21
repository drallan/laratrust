<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $client_id,
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @mixin \Eloquent
 */

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait {
        hasRole as laratrustHasRole;
        can as laratrustCan;
        hasPermission as laratrustHasPermission;
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'client_id', 'email', 'password',
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
     * Determine whether the Employee has access
     * to all areas of the site regardless of predefined permissions
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return (bool) $this->laratrustHasRole(Role::SUPER_ADMIN);
    }

    /**
     * @param string $permission
     * @param null $team
     * @param bool $requireAll
     *
     * @return bool
     */
    public function can($permission, $team = null, $requireAll = false)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        return $this->laratrustCan($permission, $team, $requireAll);
    }

    /**
     * Check if user has a permission by its name.
     *
     * @param string|array $permission permission string or array of permissions
     * @param null         $team
     * @param bool         $requireAll all permissions in the array are required
     *
     * @return bool
     */
    public function hasPermission($permission, $team = null, $requireAll = false)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->laratrustHasPermission($permission, $team, $requireAll);
    }

    /**
     * Checks if the user has a role by its name.
     *
     * @param string|array $name       role name or array of role names
     * @param null         $team
     * @param bool         $requireAll all roles in the array are required
     *
     * @return bool
     */
    public function hasRole($name, $team = null, $requireAll = false)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->laratrustHasRole($name, $team, $requireAll);
    }
}
