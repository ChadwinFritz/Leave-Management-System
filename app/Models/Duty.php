<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Duty extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'duties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'status', // Include status in fillable to allow updates
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string', // Ensure status is always treated as a string
    ];

    /**
     * A duty can be assigned to many employees.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_duties', 'duty_id', 'employee_id')
            ->withTimestamps()
            ->withPivot(['assigned_at']);
    }

    /**
     * Boot method to handle model events.
     */
    protected static function booted()
    {
        static::creating(function ($duty) {
            // Ensure unique code at the time of creation
            if (Duty::where('code', $duty->code)->exists()) {
                throw new \Exception("Duty code '{$duty->code}' must be unique.");
            }
        });
    }

    /**
     * Scope to filter duties by code.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCode($query, string $code)
    {
        return $query->where('code', $code);
    }

    /**
     * Scope to filter duties by name (case-insensitive, partial match).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, string $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    /**
     * Scope to filter active or inactive duties.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, string $status = 'active')
    {
        return $query->where('status', $status);
    }

    /**
     * Mark the duty as active.
     *
     * @return void
     */
    public function activate()
    {
        $this->update(['status' => 'active']);
    }

    /**
     * Mark the duty as inactive.
     *
     * @return void
     */
    public function deactivate()
    {
        $this->update(['status' => 'inactive']);
    }
}
