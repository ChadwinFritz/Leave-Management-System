<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = ['user_id', 'action'];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
