<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supervisor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'supervisors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'team_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'department_id' => 'integer',
        'team_id' => 'integer',
    ];

    /**
     * Relationship to the User model.
     * A supervisor is associated with a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship to the Department model.
     * A supervisor belongs to a department.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Relationship to the Team model.
     * A supervisor leads a team.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Relationship to the Employee model.
     * A supervisor supervises many employees.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'supervisor_id');
    }

    /**
     * Relationship to the LeaveRequest model.
     * A supervisor can approve or reject leave requests from their employees.
     */
    public function leaveRequests(): HasMany
    {
        return $this->hasManyThrough(LeaveRequest::class, Employee::class, 'supervisor_id', 'employee_id');
    }

    /**
     * Relationship to the EscalationRequest model.
     * A supervisor can receive escalation requests from their employees.
     */
    public function escalationRequests(): HasMany
    {
        return $this->hasManyThrough(EscalationRequest::class, Employee::class, 'supervisor_id', 'employee_id');
    }

    /**
     * Relationship to the TaskAssignment model.
     * A supervisor can assign tasks to their employees.
     */
    public function taskAssignments(): HasMany
    {
        return $this->hasManyThrough(TaskAssignment::class, Employee::class, 'supervisor_id', 'employee_id');
    }

    /**
     * Relationship to the Notification model.
     * A supervisor can receive notifications.
     */
    public function notifications(): HasMany
    {
        return $this->hasManyThrough(Notification::class, Employee::class, 'supervisor_id', 'user_id');
    }

    /**
     * Check if the supervisor is a department head.
     *
     * @return bool
     */
    public function isDepartmentHead(): bool
    {
        return $this->department_id !== null;
    }

    /**
     * Check if the supervisor is a team leader.
     *
     * @return bool
     */
    public function isTeamLeader(): bool
    {
        return $this->team_id !== null;
    }

    /**
     * Check if the supervisor is a senior supervisor (i.e. they manage multiple teams).
     *
     * @return bool
     */
    public function isSeniorSupervisor(): bool
    {
        // If a supervisor manages multiple teams, they can be considered a senior supervisor
        return $this->team()->count() > 1;
    }

    /**
     * Scope to get supervisors by department.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $departmentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Scope to get supervisors by team.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $teamId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInTeam($query, $teamId)
    {
        return $query->where('team_id', $teamId);
    }
}
