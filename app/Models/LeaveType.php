<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveType extends Model
{
    protected $table = 'leave_types';

    protected $fillable = [
        'code',
        'name',
        'has_limit',
        'limit',
    ];

    /**
     * Relationship to the Leave model.
     * A leave type can have many leaves.
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'leave_type', 'code');
    }

    /**
     * Relationship to the LeaveApplication model.
     * A leave type can have many leave applications.
     */
    public function leaveApplications(): HasMany
    {
        return $this->hasMany(LeaveApplication::class, 'leave_type', 'code');
    }
}
