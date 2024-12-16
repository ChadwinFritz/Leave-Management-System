<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\TeamReport; // Add TeamReport model
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

        // Fetch the team reports based on the selected month and year
        $teamReports = TeamReport::whereMonth('report_date', Carbon::parse($currentMonth)->month)
                                 ->whereYear('report_date', $currentYear)
                                 ->with('employee') // Eager load employee data
                                 ->get();

        // Process data for each report to prepare the data for the view
        $teamReportsData = $teamReports->map(function ($report) {
            // Return the relevant data
            return (object) [
                'employee' => $report->employee-> name,
                'performance_score' => $report->performance_score,
                'attendance_percentage' => $report->attendance_percentage,
                'leave_percentage' => $report->leave_percentage,
            ];
        });

        // Return the view with the report data
        return view('supervisor.supervisor_team_report', [
            'teamReports' => $teamReportsData,
            'months' => $months,
            'years' => $years,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
        ]);
    }
}
