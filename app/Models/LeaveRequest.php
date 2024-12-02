<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leave_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'leave_application_id',
        'request_date',
        'start_date',
        'end_date',
        'reason',
        'status', // Pending, Approved, Rejected, etc.
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'request_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Enum for possible status values.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Relationship to the Employee model.
     * A leave request belongs to an employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Relationship to the Supervisor model.
     * A leave request can be approved or rejected by the employee's supervisor.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    /**
     * Relationship to the LeaveApplication model.
     * A leave request is associated with a leave application.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leaveApplication(): BelongsTo
    {
        return $this->belongsTo(LeaveApplication::class, 'leave_application_id');
    }

    /**
     * Relationship to the Leave model.
     * A leave request can have many leave records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'leave_request_id');
    }

    /**
     * Get the status of the leave request.
     * You can add logic here to modify or check the status.
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Capitalizes status values (e.g., 'approved' becomes 'Approved')
    }

    /**
     * Example of setting the status for a leave request.
     *
     * @param string $value
     * @return void
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value); // Store status in lowercase
    }

    /**
     * Method to approve the leave request.
     * Automatically updates the status to 'approved' and performs any additional logic.
     */
    public function approve()
    {
        $this->status = self::STATUS_APPROVED;
        $this->save();
        // Additional logic for approving the leave request, such as notifying the employee
    }

    /**
     * Method to reject the leave request.
     * Automatically updates the status to 'rejected' and allows adding a rejection reason.
     *
     * @param string $reason
     * @return void
     */
    public function reject(string $reason)
    {
        $this->status = self::STATUS_REJECTED;
        $this->rejection_reason = $reason; // Add the rejection reason
        $this->save();
        // Additional logic for rejecting the leave request, such as notifying the employee
    }

    /**
     * Get the status options for leave requests.
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
