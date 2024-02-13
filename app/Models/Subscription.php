<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'subscriber'
    ];

    public function user_author()
    {
        return $this->BelongsTo(User::class, 'author', 'id');
    }

    public function user_subscriber()
    {
        return $this->BelongsTo(User::class, 'subscriber', 'id');
    }


}

