<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leaves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'leave_application_id',
        'total_leave',
        'start_date',
        'end_date',
        'start_half',
        'end_half',
        'on_date',
        'on_time',
        'leave_type',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'on_date' => 'date',
        'on_time' => 'datetime',
    ];

    /**
     * Leave status constants.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Relationship to the Employee model.
     * A leave belongs to an employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Relationship to the LeaveApplication model.
     * A leave belongs to a leave application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveApplication()
    {
        return $this->belongsTo(LeaveApplication::class, 'leave_application_id');
    }

    /**
     * Relationship to the LeaveType model.
     * A leave belongs to a specific leave type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type', 'code');
    }

    /**
     * Boot method for model events.
     * Ensure the leave status is set to "pending" when a leave is created.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leave) {
            if (empty($leave->status)) {
                $leave->status = self::STATUS_PENDING; // Default status is "pending"
            }
        });
    }

    /**
     * Scope to filter by leave status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope to filter by approved leave status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope to filter by rejected leave status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope to filter leave by date range.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('start_date', [$startDate, $endDate])
              ->orWhereBetween('end_date', [$startDate, $endDate]);
        });
    }

    /**
     * Get the full status text for the leave.
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_APPROVED:
                return 'Approved';
            case self::STATUS_REJECTED:
                return 'Rejected';
            case self::STATUS_PENDING:
            default:
                return 'Pending';
        }
    }
}
