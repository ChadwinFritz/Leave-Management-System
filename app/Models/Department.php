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
        'manager_id', // Added for tracking the department manager
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
     * Boot method to automatically assign a manager if not set.
     */
    protected static function booted()
    {
        static::creating(function ($department) {
            // Optionally set a default manager if none is provided
            if (empty($department->manager_id)) {
                // Logic to pick a default manager (could be the first employee, or based on some other business logic)
                $department->manager_id = Employee::first()->id; // Example: First employee becomes the manager
            }
        });
    }

    /**
     * Scope to get departments managed by a specific manager.
     */
    public function scopeManagedBy($query, $managerId)
    {
        return $query->where('manager_id', $managerId);
    }

    /**
     * Scope to get departments by name.
     */
    public function scopeNamed($query, $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }
}
