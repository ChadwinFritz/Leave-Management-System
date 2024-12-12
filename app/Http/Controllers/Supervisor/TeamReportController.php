<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamReportController extends Controller
{

    /**
     * Display the team performance report.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the current month and year if not provided
        $currentMonth = $request->month ?? Carbon::now()->format('F');
        $currentYear = $request->year ?? Carbon::now()->year;

        // Generate the list of months and years for the dropdowns
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        $years = range(Carbon::now()->year - 5, Carbon::now()->year);

        // Get the team members for the logged-in supervisor
        $teamMembers = Employee::where('supervisor_id', Auth::id())
                            ->with([
                                'tasks' => function ($query) use ($currentMonth, $currentYear) {
                                    // Filter tasks for the selected month and year
                                    $query->whereMonth('completed_at', Carbon::parse($currentMonth)->month)
                                            ->whereYear('completed_at', $currentYear);
                                },
                                'leaveApplications' => function ($query) use ($currentMonth, $currentYear) {
                                    // Filter leave applications for the selected month and year
                                    $query->whereMonth('start_date', Carbon::parse($currentMonth)->month)
                                            ->whereYear('start_date', $currentYear);
                                }
                            ])
                            ->get();

        // Process data for each team member to calculate report data
        $teamReports = $teamMembers->map(function ($member) use ($currentMonth, $currentYear) {
            // Calculate completed tasks count
            $completedTasks = $member->tasks->count();

            // Calculate leave days count
            $leaveDays = $member->leaveApplications->reduce(function ($carry, $leave) {
                return $carry + $leave->days; // Assuming 'days' is an attribute in LeaveApplication
            }, 0);

            // Calculate overtime hours (assuming overtime is tracked in 'overtime_hours' attribute)
            $overtimeHours = $member->tasks->sum('overtime_hours');

            return (object) [
                'employee' => $member,
                'completed_tasks' => $completedTasks,
                'leave_days' => $leaveDays,
                'overtime_hours' => $overtimeHours
            ];
        });

        // Return the view with the report data
        return view('supervisor.supervisor_team_report', [
            'teamReports' => $teamReports,
            'months' => $months,
            'years' => $years,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
        ]);
    }
}
