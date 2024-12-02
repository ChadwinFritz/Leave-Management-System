<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Availability extends Model
{
    protected $table = 'availabilities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'available_from',
        'available_to',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'available_from' => 'datetime',
        'available_to' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'active', // Default status is active
    ];

    /**
     * Relationship to the Employee model.
     * An availability belongs to an employee.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Boot method for the Availability model.
     * Used for model-specific logic like validation and automatic updates.
     */
    protected static function booted()
    {
        static::creating(function ($availability) {
            // Ensure that available_from is before available_to
            if ($availability->available_from >= $availability->available_to) {
                throw new \Exception('The start time must be before the end time.');
            }

            // Optionally, you can set the employee_id automatically based on Auth::user() if needed
            if (empty($availability->employee_id)) {
                $availability->employee_id = Auth::id();
            }
        });
    }

    /**
     * Scope to get active availabilities.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get availabilities by employee.
     */
    public function scopeForEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }
}
