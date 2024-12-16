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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hire_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
     * Boot method to handle automatic employee code generation and other logic.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            // Generate a unique employee code if not provided
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
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('employment_status', 'active');
    }

    /**
     * Scope to filter employees by department.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $departmentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInDepartment($query, int $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Scope to filter employees hired after a specific date.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|\DateTime $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHiredAfter($query, $date)
    {
        return $query->where('hire_date', '>', $date);
    }

    /**
     * Scope to filter employees hired before a specific date.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|\DateTime $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHiredBefore($query, $date)
    {
        return $query->where('hire_date', '<', $date);
    }

    /**
     * Mark an employee as active.
     *
     * @return void
     */
    public function activate()
    {
        $this->update(['employment_status' => 'active']);
    }

    /**
     * Mark an employee as inactive.
     *
     * @return void
     */
    public function deactivate()
    {
        $this->update(['employment_status' => 'inactive']);
    }

    /**
     * Define the relationship between Employee and Team.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_employee', 'employee_id', 'team_id');
    }

    public function availability()
    {
        return $this->hasOne(Availability::class);  // Assuming each employee has one availability record
    }

}
