<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'hire_date',
        'user_id',
        'department_id',
        'duty_id',
        'employee_code',
        'employment_status',
        'notes',
    ];

    /**
     * Relationship to the User model.
     * An employee belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship to the Department model.
     * An employee belongs to a department.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Relationship to the Duty model.
     * An employee belongs to a duty.
     */
    public function duty(): BelongsTo
    {
        return $this->belongsTo(Duty::class, 'duty_id');
    }

    /**
     * Relationship to the LeaveApplication model.
     * An employee can have many leave applications.
     */
    public function leaveApplications(): HasMany
    {
        return $this->hasMany(LeaveApplication::class, 'employee_id');
    }

    /**
     * Relationship to the Leave model.
     * An employee can have many leaves.
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            // Generate employee_code automatically
            $lastEmployee = self::orderBy('id', 'desc')->first();
            $nextCode = $lastEmployee ? intval(substr($lastEmployee->employee_code, 3)) + 1 : 1;
            $employee->employee_code = 'EMP' . str_pad($nextCode, 5, '0', STR_PAD_LEFT); // Example: EMP00001
        });
    }

    public function leaveTypes()
    {
        return $this->hasMany(LeaveType::class);
    }
}
