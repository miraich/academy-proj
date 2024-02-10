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

    public function users()
    {
        return $this->BelongsTo(User::class);
    }


}

