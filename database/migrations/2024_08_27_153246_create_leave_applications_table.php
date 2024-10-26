<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->increments('id');
            
            // Foreign key to the employees table
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            
            // Foreign key to the leave_types table
            $table->unsignedInteger('leave_type_id');
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('set null');
            
            // Leave details
            $table->date('start_date'); // Start date of the leave
            $table->date('end_date'); // End date of the leave
            $table->string('start_half')->nullable(); // Half-day status for the start of leave
            $table->string('end_half')->nullable(); // Half-day status for the end of leave
            $table->integer('number_of_days'); // Number of leave days
            
            // Optional fields for specific date and time
            $table->date('on_date')->nullable(); // Specific date, if applicable
            $table->time('on_time')->nullable(); // Specific time, if applicable
            
            // Reason and rejection details
            $table->string('reason'); // Reason for the leave request
            $table->string('rejection_reason')->nullable(); // Reason for rejection, if applicable
            
            // Total leave count and status
            $table->unsignedInteger('total_leave')->nullable(); // Total number of leave days (nullable if not calculated yet)
            $table->string('status')->default('pending'); // Status of the leave application (e.g., pending, approved, rejected)
            
            // Timestamps functionality
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_applications');
    }
}
