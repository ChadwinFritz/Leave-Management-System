<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'message',
        'status', // 'read', 'unread', or other custom statuses
        'date_sent',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_sent' => 'datetime',
    ];

    /**
     * Relationship to the User model.
     * A notification belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the status of the notification.
     * Add logic to handle custom statuses.
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Capitalizes the status value for display (e.g., 'read' -> 'Read')
    }

    /**
     * Set the status of the notification.
     * Ensures status is always stored in lowercase for consistency.
     *
     * @param string $value
     * @return void
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value); // Store status in lowercase
    }

    /**
     * Scope a query to only include unread notifications.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope a query to only include notifications sent to a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Mark the notification as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Mark the notification as unread.
     *
     * @return void
     */
    public function markAsUnread()
    {
        $this->update(['status' => 'unread']);
    }

    /**
     * Get the formatted date sent.
     * You can add any custom formatting logic here.
     *
     * @return string
     */
    public function getFormattedDateSentAttribute()
    {
        return $this->date_sent->format('F j, Y, g:i a'); // Example formatting
    }
}