<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Availability extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
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
        'status' => 'available', // Default status is 'available'
    ];

    /**
     * Relationship: An availability belongs to an employee.
     *
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Boot method for model-specific logic like validation and automatic updates.
     */
    protected static function booted()
    {
        static::creating(function ($availability) {
            // Ensure that available_from is before available_to
            if ($availability->available_from >= $availability->available_to) {
                throw new \Exception('The start time must be before the end time.');
            }

            // If employee_id is not set, optionally use Auth::user()->id
            if (empty($availability->employee_id) && Auth::check()) {
                $availability->employee_id = Auth::id();
            }
        });
    }

    /**
     * Scope to filter active availabilities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope to filter availabilities for a specific employee.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $employeeId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForEmployee($query, $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Check if the availability overlaps with another time period.
     *
     * @param string $from
     * @param string $to
     * @return bool
     */
    public function overlaps($from, $to): bool
    {
        return $this->available_from < $to && $this->available_to > $from;
    }

    /**
     * Scope to find availabilities that overlap with a given time range.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $from
     * @param string $to
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverlapping($query, $from, $to)
    {
        return $query->where(function ($q) use ($from, $to) {
            $q->where('available_from', '<', $to)
              ->where('available_to', '>', $from);
        });
    }
}
