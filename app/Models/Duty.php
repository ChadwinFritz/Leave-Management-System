<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duty extends Model
{
    protected $table = 'duties';

    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    /**
     * Relationship to the Employee model.
     * A duty can be assigned to many employees.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'duty_id');
    }
}
