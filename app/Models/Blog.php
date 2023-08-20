<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * This class acts as a representative of the blogs table in the database.
 *
 * @package App\Models
 *
 * @author Max Harris <MaxHarrisMJH@gmail.com>
 *
 * @version v0.0.1
 *
 * @since v0.0.1
 */
class Blog extends Model
{
    // As a class can only extend once, use further classes here.
    use HasFactory;

    /**
     * @var string $table Define the name of the table.
     */
    protected $table = 'blogs';

    /**
     * @var string $primaryKey Defines the primary key of the table.
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array $fillable The attributes that are mass assignable.
     */
    protected $fillable = [
        'blog_title',
        'blog_abstract',
        'blog_content',
        'user_id',
        'blog_image',
        'blog_slug',
        'created_at',
        'updated_at',
    ];

    /**
     * @var array $casts The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * In order to get the user that created a specific blog,
     * using Eloquent's relations assigner, this will return the
     * specific user. It is expected for one blog to have only one
     * user associated with it.
     *
     * @return BelongsTo Retuns a BelongsTo relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * This function aims to get the fullname of the user that wrote
     * each blog stored within the database. It utilises Laravel's
     * Collections class to perform mapping, as well as returning mapped
     * values as a PHP array.
     *
     * @return array Returns an array of all blogs owners's full name.
     */
    public static function getBlogOwners(): array
    {
        // Map each blog to find their owner's fullname and return the result.
        return Blog::all()->map(function (Blog $blog) {
            $firstname = $blog->user->firstname;
            $lastname = $blog->user->lastname;

            return "${firstname} ${lastname}";
        })->all();
    }
}
