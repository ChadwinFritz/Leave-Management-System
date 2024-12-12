<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    /**
     * Show the form to assign tasks to team members.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Fetch the team members assigned to the supervisor (assuming supervisor has a team relationship with employees)
        $teamMembers = Employee::where('supervisor_id', Auth::id())->get();

        // Pass the team members to the view
        return view('supervisor.supervisor_assign_tasks', compact('teamMembers'));
    }

    /**
     * Store the newly assigned task.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'employee_id' => 'required|exists:employees,id',  // Ensure employee exists
            'task_description' => 'required|string|max:1000',  // Ensure task description is a string and has a max length
            'deadline' => 'required|date|after:today',  // Deadline must be a valid date after today
        ]);

        // Create a new task for the selected employee
        Task::create([
            'employee_id' => $request->employee_id,
            'supervisor_id' => Auth::id(),  // Set the supervisor ID from the logged-in user
            'task_description' => $request->task_description,
            'deadline' => $request->deadline,
        ]);

        // Redirect back to the form with a success message
        return redirect()->route('supervisor.assign_task')
                         ->with('success', 'Task successfully assigned to the employee!');
    }
}
