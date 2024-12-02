<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class TaskAssignment extends Model
{
    protected $table = 'task_assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'task_id',
        'assigned_by',
        'status',
        'due_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Status constants to easily manage assignment statuses
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_ARCHIVED = 'archived';

    /**
     * Relationship to the Employee model.
     * A task assignment belongs to an employee.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Relationship to the Task model.
     * A task assignment belongs to a task.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    /**
     * Relationship to the User model (assigned by).
     * A task assignment is created by a user (like a manager or supervisor).
     */
    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Relationship to the Supervisor model.
     * A task assignment can be created by the employee's supervisor.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    /**
     * Get the status label for the task assignment.
     *
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_IN_PROGRESS:
                return 'In Progress';
            case self::STATUS_COMPLETED:
                return 'Completed';
            case self::STATUS_ARCHIVED:
                return 'Archived';
            default:
                return 'Unknown';
        }
    }

    /**
     * Check if the task assignment is completed.
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Scope to filter task assignments by status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter task assignments by employee.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $employeeId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignedToEmployee($query, int $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope to filter task assignments by task.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $taskId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTask($query, int $taskId)
    {
        return $query->where('task_id', $taskId);
    }

    /**
     * Boot the model and register event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($taskAssignment) {
            // Cache the task assignment if needed (optional)
            Cache::put('task_assignment_' . $taskAssignment->id, $taskAssignment);
        });

        static::updated(function ($taskAssignment) {
            // Clear the task assignment cache on update (optional)
            Cache::forget('task_assignment_' . $taskAssignment->id);
            Cache::put('task_assignment_' . $taskAssignment->id, $taskAssignment);
        });

        static::deleted(function ($taskAssignment) {
            // Remove task assignment from cache upon deletion (optional)
            Cache::forget('task_assignment_' . $taskAssignment->id);
        });
    }

    /**
     * Get a list of all possible task assignment statuses.
     *
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }
}
