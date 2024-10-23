<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            
            // Foreign key to the employees table
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            
            // Foreign key to the leave applications table
            $table->unsignedInteger('leave_application_id')->unique(); // Unique identifier for the leave application
            $table->foreign('leave_application_id')->references('id')->on('leave_applications')->onDelete('cascade');
            
            // Total number of leave days (nullable in case it's not calculated yet)
            $table->unsignedInteger('total_leave')->nullable(); 
            
            // Start and end dates for the leave
            $table->date('start_date');
            $table->date('end_date');
            
            // Optional half-day status for the start and end of leave
            $table->string('start_half')->nullable(); 
            $table->string('end_half')->nullable(); 
            
            // Specific date and time, if applicable (for single-day or specific leave)
            $table->date('on_date')->nullable(); 
            $table->time('on_time')->nullable(); 
            
            // Foreign key to the leave types table
            $table->string('leave_type'); // This will refer to the leave_types table
            $table->foreign('leave_type')->references('code')->on('leave_types')->onDelete('cascade'); // Assuming leave_type stores the code from leave_types table
            
            // Standard timestamps column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
