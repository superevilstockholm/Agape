<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class ActivityLogs extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'url',
        'method',
        'response_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
