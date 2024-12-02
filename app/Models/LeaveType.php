<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class LeaveType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leave_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'has_limit',
        'limit',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_limit' => 'boolean', // Ensures 'has_limit' is always a boolean value
        'limit' => 'integer', // Cast 'limit' to an integer, as it will store the number of leaves allowed
    ];

    /**
     * Relationship to the Leave model.
     * A leave type can have many leaves.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'leave_type_id'); // A leave type can have many leaves associated with it
    }

    /**
     * Relationship to the LeaveApplication model.
     * A leave type can have many leave applications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaveApplications(): HasMany
    {
        return $this->hasMany(LeaveApplication::class, 'leave_type_id'); // A leave type can be associated with many leave applications
    }

    /**
     * Get the status of whether the leave type has a limit.
     *
     * @return string
     */
    public function getHasLimitAttribute($value)
    {
        return $value ? 'Yes' : 'No'; // Display 'Yes' or 'No' for clarity in the UI
    }

    /**
     * Define the behavior when the 'has_limit' attribute is being set.
     * Ensures it is a boolean value.
     *
     * @param bool $value
     * @return void
     */
    public function setHasLimitAttribute($value)
    {
        $this->attributes['has_limit'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Automatically calculate the remaining leave balance for the type.
     * This assumes you want to calculate remaining leave based on leaves used.
     *
     * @return int
     */
    public function remainingLeaveBalance()
    {
        if ($this->has_limit && $this->limit > 0) {
            $usedLeaves = $this->leaves->sum('days_taken'); // Assuming 'days_taken' field exists in the Leave model
            return max(0, $this->limit - $usedLeaves);
        }

        return -1; // Return -1 if no limit is set (unlimited leave type)
    }

    /**
     * Scope to filter leave types by the presence of a limit.
     * Useful for querying leave types with or without limits.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool $withLimit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithLimit($query, $withLimit = true)
    {
        return $query->where('has_limit', $withLimit);
    }

    /**
     * Scope to filter leave types by a specific leave code.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }
}
