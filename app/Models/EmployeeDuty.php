<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeDuty extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employee_duties';

    /**
     * The primary key associated with the table.
     *
     * @var array
     */
    protected $primaryKey = ['employee_id', 'duty_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'duty_id',
        'assigned_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'assigned_at' => 'datetime', // Cast the assigned_at field to a DateTime instance
    ];

    /**
     * Relationship with the Employee model.
     * An employee duty belongs to an employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Relationship with the Duty model.
     * An employee duty belongs to a duty.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function duty(): BelongsTo
    {
        return $this->belongsTo(Duty::class, 'duty_id');
    }

    /**
     * Scope to filter duties by employee.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $employeeId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByEmployee($query, int $employeeId)
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope to filter duties by duty type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $dutyId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDuty($query, int $dutyId)
    {
        return $query->where('duty_id', $dutyId);
    }
}
