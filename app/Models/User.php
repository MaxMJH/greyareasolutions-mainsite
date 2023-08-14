<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\RoleEnum;
use Carbon\Carbon;

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
 * @version v0.0.1
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

    /**
     * First checks if the user in question is already locked out,
     * if not, it will increment the 'failed_attempts' value.
     * This method also defines the number of failed attempts allowed
     * before the account is loccked (currently 10).
     *
     * @param string $email Email address of a potential user.
     */
    public static function addFailedAttempt(string $email): void
    {
        // Check to see if the account is already locked.
        if (!self::where('email', $email)->first()->is_locked) {
            // Add 1 failed attempt.
            self::where('email', $email)->increment('failed_attempts');

            // If the number of failed attempts is equal to 10, lock the account.
            if (self::where('email', $email)->first()->failed_attempts === 10)
                self::lockAccount($email);
        }
    }

    /**
     * Locks the account be setting the 'is_locked' value to 1.
     * Also, resets the failed attempts back to 0.
     *
     * @param string $email Email address of a potential user.
     */
    public static function lockAccount(string $email): void
    {
        self::where('email', $email)->update(['is_locked' => 1, 'failed_attempts' => 0, 'lock_till' => Carbon::now()->addMinutes(30)]);
    }

    /**
     * Updates the latest successful logins.
     *
     * @param string $email Email address of a potential user.
     */
    public static function updateLastLogin(string $email): void
    {
        self::where('email', $email)->update(['last_login' => Carbon::now()]);
    }

    /**
     * Checks to see if the user email exists.
     *
     * @param string $email Email address of a potential user.
     *
     * @return bool Returns true if the email exists, false otherwise.
     */
    public static function userExists(string $email): bool
    {
        // Check if the returned where query is empty.
        return !self::where('email', $email)->get()->isEmpty();
    }
}
