<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    // Define constants for user levels
    const LEVEL_USER = 0;
    const LEVEL_ADMIN = 1;
    const LEVEL_SUPER_ADMIN = 2;
    const LEVEL_SUPERVISOR = 3;

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
     * Accessor for the full name of the user (if needed).
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name; // Customize based on how full name is structured in your system
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
     * Get the user's role description.
     * 
     * @return string
     */
    public function getRoleDescriptionAttribute()
    {
        return $this->getLevelDescription();
    }

    /**
     * Retrieve the user level as a string instead of a number.
     *
     * @return string
     */
    public function getRoleAsString()
    {
        return $this->getLevelDescription();
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
}
