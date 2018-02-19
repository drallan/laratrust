<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $brief_name
 * @property string $name
 * @property string $email
 * @property string $address,
 * @property string $city
 * @property string $postal_code
 * @property string $phone
 * @property string $cell
 * @property string $fax
 * @property Carbon $deleted_at
 * @property User[]|Collection $users
 */
class Client extends Model
{
    protected $table = 'clients';

    const DEFAULT_CLIENT_ID = 1;

    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'email' => 'string',
        'address,' => 'string',
        'city' => 'string',
        'postal_code' => 'string',
        'phone' => 'string',
        'cell' => 'string',
        'fax' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class, 'client_id');
    }

}
