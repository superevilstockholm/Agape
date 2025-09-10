<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
