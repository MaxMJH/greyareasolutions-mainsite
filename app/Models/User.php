<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\RoleEnum;

/**
 * This class acts as a representative of the users table in the database.
 *
 * Due to the class extending Illuminate\Foundation\Auth\User, rather than
 * eloquent's Model, HasFactory has to be included further into the class.
 * However, as stated prior, this model is eloquent, allowing for injection
 * with requests, as well as a wealth of database accessibility.
 *
 * @package App\Models
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @since v0.0.1
 *
 * @since v0.0.1
 */
class User extends Authenticatable
{
    // As a class can only extend once, use further classes here.
    use HasFactory, Notifiable;

    /**
     * @var string $table Define the name of the table.
     */
    protected $table = 'users';

    /**
     * @var string $primaryKey Defines the primary key of the table.
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array<int, string> $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'role',
        'last_login',
        'failed_attempts',
        'is_locked',
        'lock_till',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array<int, string> $hidden The attributes that should be hidden for serialisation.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var array<string, string> $casts The attributes that should be cast.
     */
    protected $casts = [
        'password' => 'hashed',
        'role' => RoleEnum::class,
        'last_login' => 'datetime',
        'lock_till' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
