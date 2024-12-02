<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'hire_date',
        'user_id',
        'department_id',
        'employee_code',
        'employment_status',
        'notes',
    ];

    /**
     * Relationship to the User model.
     * An employee belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship to the Department model.
     * An employee belongs to a department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Relationship to the Duty model.
     * An employee may have multiple duties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function duties(): BelongsToMany
    {
        return $this->belongsToMany(Duty::class, 'employee_duties', 'employee_id', 'duty_id')
            ->withTimestamps()
            ->withPivot(['assigned_at']);
    }

    /**
     * Relationship to the LeaveApplication model.
     * An employee can have many leave applications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaveApplications(): HasMany
    {
        return $this->hasMany(LeaveApplication::class, 'employee_id');
    }

    /**
     * Relationship to the Leave model.
     * An employee can have many leaves.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }

    /**
     * Relationship to the LeaveType model.
     * An employee can have many leave types.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaveTypes(): HasMany
    {
        return $this->hasMany(LeaveType::class);
    }

    /**
     * Relationship to the Supervisor model.
     * An employee has a supervisor.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    /**
     * Boot method for model events.
     * Automatically generates the employee code upon creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            // Generate employee_code automatically
            if (empty($employee->employee_code)) {
                $lastEmployee = self::orderBy('id', 'desc')->first();
                $nextCode = $lastEmployee ? intval(substr($lastEmployee->employee_code, 3)) + 1 : 1;
                $employee->employee_code = 'EMP' . str_pad($nextCode, 5, '0', STR_PAD_LEFT); // Example: EMP00001
            }
        });
    }

    /**
     * Scope to filter active employees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeActive($query)
    {
        return $query->where('employment_status', 'active');
    }

    /**
     * Scope to filter employees by department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeInDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Scope to filter employees by hire date.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeHiredAfter($query, $date)
    {
        return $query->where('hire_date', '>', $date);
    }
}
