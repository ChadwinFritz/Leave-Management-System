<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class TeamReport extends Model
{
    protected $table = 'team_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'report_date',
        'performance_score',
        'attendance_percentage',
        'leave_percentage',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'report_date' => 'date',
    ];

    /**
     * Relationship to the Team model.
     * A team report belongs to a team.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * Scope to filter reports by date range.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $startDate
     * @param \Carbon\Carbon $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('report_date', [$startDate, $endDate]);
    }

    /**
     * Scope to filter reports by performance score.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $minScore
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMinPerformanceScore($query, $minScore)
    {
        return $query->where('performance_score', '>=', $minScore);
    }

    /**
     * Scope to filter reports by attendance percentage.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $minAttendance
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMinAttendance($query, $minAttendance)
    {
        return $query->where('attendance_percentage', '>=', $minAttendance);
    }

    /**
     * Scope to filter reports by leave percentage.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $maxLeave
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaxLeave($query, $maxLeave)
    {
        return $query->where('leave_percentage', '<=', $maxLeave);
    }

    /**
     * Helper method to get formatted performance score.
     *
     * @return string
     */
    public function getFormattedPerformanceScore(): string
    {
        return number_format($this->performance_score, 2) . '%';
    }

    /**
     * Helper method to get formatted attendance percentage.
     *
     * @return string
     */
    public function getFormattedAttendancePercentage(): string
    {
        return number_format($this->attendance_percentage, 2) . '%';
    }

    /**
     * Helper method to get formatted leave percentage.
     *
     * @return string
     */
    public function getFormattedLeavePercentage(): string
    {
        return number_format($this->leave_percentage, 2) . '%';
    }

    /**
     * Boot the model and register event listeners for caching.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($report) {
            // Cache the report when created (optional)
            Cache::put('team_report_' . $report->id, $report);
        });

        static::updated(function ($report) {
            // Clear cache when report is updated (optional)
            Cache::forget('team_report_' . $report->id);
            Cache::put('team_report_' . $report->id, $report);
        });

        static::deleted(function ($report) {
            // Remove report from cache upon deletion (optional)
            Cache::forget('team_report_' . $report->id);
        });
    }

    /**
     * Get the report for a specific team within a date range.
     *
     * @param int $teamId
     * @param \Carbon\Carbon $startDate
     * @param \Carbon\Carbon $endDate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getReportForTeamByDateRange(int $teamId, $startDate, $endDate)
    {
        return self::byDateRange($startDate, $endDate)->where('team_id', $teamId)->get();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
