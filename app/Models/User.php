<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend the Authenticatable class
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable // Change this to extend Authenticatable
{
    use Notifiable; // Include Notifiable trait

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'level',
        'username',
        'password',
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

    // Check if user is a regular user
    public function isUser()
    {
        return $this->level === 0; // Define LEVEL_USER constant if you use it, or set directly to 0
    }

    // Check if user is an admin
    public function isAdmin()
    {
        return $this->level === 1; // Define LEVEL_ADMIN constant if you use it, or set directly to 1
    }

    // Check if user is a super admin
    public function isSuperAdmin()
    {
        return $this->level === 2; // Define LEVEL_SUPER_ADMIN constant if you use it, or set directly to 2
    }
}
