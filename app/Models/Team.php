<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Team extends Model
{
    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id', // Changed supervisor_id to user_id
        'department_id',
    ];

    /**
     * The relationships and their methods.
     */
    
    /**
     * Relationship to the Employee model.
     * A team has many employees.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'team_id');
    }

    /**
     * Relationship to the User model.
     * A team is led by a user (previously supervisor).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id'); // Changed from supervisor to user
    }

    /**
     * Relationship to the Department model.
     * A team belongs to a department.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Scope to filter teams by department.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $departmentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDepartment($query, int $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Scope to filter teams by user (previously supervisor).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId); // Changed from supervisor_id to user_id
    }

    /**
     * Get the full name of the user leading the team.
     *
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user ? $this->user->full_name : 'No user assigned'; // Changed supervisor to user
    }

    /**
     * Boot the model and register event listeners for caching.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($team) {
            // Cache the team if needed (optional)
            Cache::put('team_' . $team->id, $team);
        });

        static::updated(function ($team) {
            // Clear the cached team on update (optional)
            Cache::forget('team_' . $team->id);
            Cache::put('team_' . $team->id, $team);
        });

        static::deleted(function ($team) {
            // Remove the team from cache upon deletion (optional)
            Cache::forget('team_' . $team->id);
        });
    }

    /**
     * Get a list of all teams in a specific department.
     *
     * @param int $departmentId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTeamsByDepartment(int $departmentId)
    {
        return self::byDepartment($departmentId)->get();
    }

    /**
     * Get a list of all teams led by a specific user (previously supervisor).
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTeamsByUser(int $userId)
    {
        return self::byUser($userId)->get(); // Changed from supervisorId to userId
    }
}
