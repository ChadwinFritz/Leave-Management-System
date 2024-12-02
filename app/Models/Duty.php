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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'assigned_at' => 'datetime', // Automatically cast 'assigned_at' to datetime when retrieved
    ];

    /**
     * Relationship: A duty can be assigned to many employees.
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
     * Boot method to handle pivot table logic, like updating the assigned_at timestamp.
     */
    protected static function booted()
    {
        static::creating(function ($duty) {
            // Optionally validate the uniqueness of 'code' or 'name'
            if (Duty::where('code', $duty->code)->exists()) {
                throw new \Exception("Duty code must be unique.");
            }
        });

        static::updating(function ($duty) {
            // Custom logic when duty is updated, if needed
        });
    }

    /**
     * Scope to filter duties by code.
     */
    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    /**
     * Scope to filter duties by name.
     */
    public function scopeByName($query, $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }
}
