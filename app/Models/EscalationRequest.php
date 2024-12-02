<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EscalationRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'escalation_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'supervisor_id',
        'reason',
        'status',
        'date_requested',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_requested' => 'datetime',
    ];

    /**
     * Define constants for status.
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Relationship to the Employee model.
     * An escalation request belongs to an employee.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Relationship to the Supervisor model.
     * An escalation request belongs to a supervisor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'supervisor_id'); // Assuming Supervisor is also an Employee model
    }

    /**
     * Boot method for model events.
     * Ensure the status is set to "pending" when an escalation request is created.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($escalationRequest) {
            if (empty($escalationRequest->status)) {
                $escalationRequest->status = self::STATUS_PENDING;
            }
        });
    }

    /**
     * Scope to filter by status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope to filter by approved status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope to filter by rejected status.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope to filter by date requested.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRequestedAfter($query, $date)
    {
        return $query->where('date_requested', '>', $date);
    }

    /**
     * Get the full status text.
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
