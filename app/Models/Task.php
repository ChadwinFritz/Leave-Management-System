<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'description', 'status', 'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',  // Assuming 'status' is a string or enum, cast appropriately
    ];

    /**
     * The relationship with the User model.
     * A task belongs to a user (assigned to a user).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define a status constant for easier management and better readability.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_ARCHIVED = 'archived';

    /**
     * Get the human-readable status.
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
     * Check if the task is completed.
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Scope to filter tasks by status.
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
     * Boot the model and register event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            // Cache the task if needed (optional)
            Cache::put('task_' . $task->id, $task);
        });

        static::updated(function ($task) {
            // Clear the task cache on update (optional)
            Cache::forget('task_' . $task->id);
            Cache::put('task_' . $task->id, $task);
        });

        static::deleted(function ($task) {
            // Remove task from cache upon deletion (optional)
            Cache::forget('task_' . $task->id);
        });
    }

    /**
     * Get a list of all possible task statuses.
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

    /**
     * Get a query builder for tasks assigned to a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignedToUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}
