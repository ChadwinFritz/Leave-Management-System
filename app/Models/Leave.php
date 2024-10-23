<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';

    protected $fillable = [
        'employee_id',
        'leave_application_id', // Updated from application_id to leave_application_id
        'total_leave',
        'start_date',
        'end_date',
        'start_half',
        'end_half',
        'on_date',
        'on_time',
        'leave_type',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'on_date' => 'date',
        'on_time' => 'datetime',
    ];

    /**
     * Relationship to the User model.
     * A leave belongs to an employee (user).
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Relationship to the LeaveApplication model.
     * A leave belongs to a leave application.
     */
    public function leaveApplication()
    {
        return $this->belongsTo(LeaveApplication::class, 'leave_application_id');
    }

    /**
     * Relationship to the LeaveType model.
     * A leave belongs to a specific leave type.
     */
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type', 'code'); // Assuming leave_type stores the code from leave_types table
    }
}
