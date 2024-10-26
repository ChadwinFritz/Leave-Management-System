<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApplication extends Model
{
    protected $table = 'leave_applications';

    protected $fillable = [
        'employee_id',
        'leave_type_id', // Updated to reflect the foreign key
        'start_date',
        'end_date',
        'start_half',
        'end_half',
        'number_of_days',
        'on_date',
        'on_time',
        'reason',
        'rejection_reason',
        'total_leave',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'on_date' => 'date',
        'on_time' => 'datetime',
    ];

    /**
     * Relationship to the Employee model.
     * A leave application belongs to an employee.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Relationship to the Leave model.
     * A leave application can have many leaves.
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'leave_application_id');
    }

    /**
     * Relationship to the LeaveType model.
     * A leave application belongs to a specific leave type.
     */
    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
}
