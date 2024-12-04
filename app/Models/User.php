<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $table = 'users';

    // Define constants for user levels
    const LEVEL_USER = 0;
    const LEVEL_ADMIN = 1;
    const LEVEL_SUPER_ADMIN = 2;
    const LEVEL_SUPERVISOR = 3;

    // Define constants for statuses
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'name',
        'email',
        'level',
        'username',
        'password',
        'status',
        'is_approved',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relationship to the Employee model.
     * A user can have one employee record.
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id');
    }

    /**
     * Relationship to the LeaveApplication model.
     * A user can have many leave applications through the employee record.
     */
    public function leaveApplications(): HasMany
    {
        return $this->hasManyThrough(LeaveApplication::class, Employee::class, 'user_id', 'employee_id');
    }

    /**
     * Check if the user is a regular user.
     * 
     * @return bool
     */
    public function isUser()
    {
        return $this->level === self::LEVEL_USER;
    }

    /**
     * Check if the user is an admin.
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->level === self::LEVEL_ADMIN;
    }

    /**
     * Check if the user is a super admin.
     * 
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->level === self::LEVEL_SUPER_ADMIN;
    }

    /**
     * Check if the user is a supervisor.
     * 
     * @return bool
     */
    public function isSupervisor()
    {
        return $this->level === self::LEVEL_SUPERVISOR;
    }

    /**
     * Check if the user is approved.
     * 
     * @return bool
     */
    public function isApproved()
    {
        return $this->is_approved;
    }

    /**
     * Get the level description for the user.
     * 
     * @return string
     */
    public function getLevelDescription()
    {
        switch ($this->level) {
            case self::LEVEL_USER:
                return 'User';
            case self::LEVEL_ADMIN:
                return 'Admin';
            case self::LEVEL_SUPER_ADMIN:
                return 'Super Admin';
            case self::LEVEL_SUPERVISOR:
                return 'Supervisor';
            default:
                return 'Unknown';
        }
    }

    /**
     * Mutator to hash password before saving it.
     * 
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Scope to filter users by level.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $level
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Scope to filter users by status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter approved users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
