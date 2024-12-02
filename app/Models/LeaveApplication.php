<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class LeaveApplication extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leave_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'leave_type_id', // Updated to reflect the foreign key
        'start_date',
        'end_date',
        'start_half',
        'end_half',
        'number_of_days',
        'on_date',
        'on_time',
        'reason',
        'rejection_reason',
        'total_leave',
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
     * Enum for possible status values.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the employee associated with the leave application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the leaves associated with the leave application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'leave_application_id');
    }

    /**
     * Get the leave type associated with the leave application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    /**
     * Boot method to auto-calculate the number of days on creation or update.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($leaveApplication) {
            // Ensure the number of days is automatically calculated.
            $leaveApplication->number_of_days = $leaveApplication->calculateLeaveDays();
            
            // Ensure the start date is before the end date
            if ($leaveApplication->start_date > $leaveApplication->end_date) {
                throw new \Exception('Start date cannot be after end date.');
            }

            // Ensure there are no overlapping leave requests for the same employee
            if ($leaveApplication->hasOverlappingLeave()) {
                throw new \Exception('The employee has overlapping leave during the requested period.');
            }
        });
    }

    /**
     * Calculate the number of days for the leave application.
     *
     * @return int
     */
    public function calculateLeaveDays(): int
    {
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);

        // Include half-day considerations if start_half and end_half are set
        $days = $start->diffInDays($end) + 1; // +1 to include the start date itself

        if ($this->start_half) {
            $days -= 0.5; // Deduct half a day if start_half is true
        }

        if ($this->end_half) {
            $days -= 0.5; // Deduct half a day if end_half is true
        }

        return max(1, $days); // Ensure at least 1 day is calculated
    }

    /**
     * Check if there are overlapping leaves for the same employee.
     *
     * @return bool
     */
    public function hasOverlappingLeave(): bool
    {
        $overlappingLeave = LeaveApplication::where('employee_id', $this->employee_id)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                      ->orWhereBetween('end_date', [$this->start_date, $this->end_date]);
            })
            ->where('status', self::STATUS_APPROVED) // Check only approved leaves
            ->exists();

        return $overlappingLeave;
    }

    /**
     * Approve the leave application and send a notification.
     *
     * @return void
     */
    public function approve()
    {
        $this->status = self::STATUS_APPROVED;
        $this->save();

        // Send notification to employee or supervisor
        Notification::send($this->employee, new LeaveApplicationApprovedNotification($this));
    }

    /**
     * Reject the leave application and send a notification.
     *
     * @return void
     */
    public function reject()
    {
        $this->status = self::STATUS_REJECTED;
        $this->save();

        // Send notification to employee or supervisor
        Notification::send($this->employee, new LeaveApplicationRejectedNotification($this));
    }

    /**
     * Get the status options for the leave application.
     *
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
        ];
    }
}
