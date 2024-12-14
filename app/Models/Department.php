<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'manager_id',
        'supervisor_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'string', // Ensures status is always a string
    ];

    /**
     * Relationship: A department can have many employees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id');
    }

    /**
     * Relationship: A department has one manager (Employee).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    /**
     * Relationship: A department has one supervisor (Employee).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    /**
     * Boot method to handle default values or custom logic.
     */
    protected static function booted()
    {
        static::creating(function ($department) {
            // Example logic to ensure a manager is assigned
            if (empty($department->manager_id)) {
                $department->manager_id = Employee::first()->id; // Default to the first employee, for example
            }
        });
    }

    /**
     * Scope to get departments managed by a specific manager.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $managerId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeManagedBy($query, int $managerId)
    {
        return $query->where('manager_id', $managerId);
    }

    /**
     * Scope to get departments supervised by a specific supervisor.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $supervisorId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSupervisedBy($query, int $supervisorId)
    {
        return $query->where('supervisor_id', $supervisorId);
    }

    /**
     * Scope to filter departments by name (partial match).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNamed($query, string $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    /**
     * Scope to filter active or inactive departments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, string $status = 'active')
    {
        return $query->where('status', $status);
    }

    /**
     * Mark the department as active.
     *
     * @return void
     */
    public function activate()
    {
        $this->update(['status' => 'active']);
    }

    /**
     * Mark the department as inactive.
     *
     * @return void
     */
    public function deactivate()
    {
        $this->update(['status' => 'inactive']);
    }

    /**
     * Get the users for the department.
     */
    public function users()
    {
        return $this->hasMany(User::class); // A department has many users
    }
}
