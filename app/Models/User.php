<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Termwind\Components\Li;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function likes(int $post_id)
    {
        return $this->hasMany(Like::class)->where('post_id', $post_id);
    }

    public function users_who_liked(int $author_id)
    {
        return $this->hasMany(Like::class)->where('user_id', $author_id);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function get_posts_count()
    {
        return $this->hasMany(Post::class)->count();
    }

    public function get_subscribers_count()
    {
        return $this->hasMany(Subscription::class, 'author')->count();
    }

    public function author()
    {
        return $this->hasMany(Subscription::class, 'author');
    }

    public function subscriber(): HasMany
    {
        return $this->hasMany(Subscription::class, 'subscriber');
    }

    public function subscribed_on_author(int $author_id)
    {
        return $this->hasMany(Subscription::class, 'subscriber')->where('author', $author_id);
    }


}
