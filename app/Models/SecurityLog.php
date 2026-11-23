<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    protected $fillable = [
        'incident_id',
        'ip_address',
        'threat_type',
        'severity',
        'method',
        'url',
        'user_agent',
        'reason',
        'action_taken',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
