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
        'supervisor_id',
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
     * Relationship to the Supervisor model.
     * A team is led by a supervisor.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
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
     * Scope to filter teams by supervisor.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $supervisorId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySupervisor($query, int $supervisorId)
    {
        return $query->where('supervisor_id', $supervisorId);
    }

    /**
     * Get the full name of the supervisor leading the team.
     *
     * @return string
     */
    public function getSupervisorName(): string
    {
        return $this->supervisor ? $this->supervisor->full_name : 'No supervisor assigned';
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
     * Get a list of all teams led by a specific supervisor.
     *
     * @param int $supervisorId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTeamsBySupervisor(int $supervisorId)
    {
        return self::bySupervisor($supervisorId)->get();
    }
}
