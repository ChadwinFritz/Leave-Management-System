<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade'); // FK to employees table with cascade delete
            $table->foreignId('leave_type_id')->constrained('leave_types')->onDelete('restrict'); // FK to leave_types table with restrict delete
            $table->date('start_date'); // Start date of leave
            $table->date('end_date'); // End date of leave
            $table->boolean('start_half')->default(false); // Indicates if the start day is a half-day
            $table->boolean('end_half')->default(false); // Indicates if the end day is a half-day
            $table->decimal('number_of_days', 8, 2); // Total number of leave days
            $table->date('on_date')->nullable(); // Optional single-day leave date
            $table->dateTime('on_time')->nullable(); // Optional time-specific leave
            $table->text('reason')->nullable(); // Reason for the leave application
            $table->text('rejection_reason')->nullable(); // Reason for rejection (if applicable)
            $table->decimal('total_leave', 8, 2)->default(0); // Total leave hours/days used
            $table->string('status')->default('pending'); // Leave status: pending, approved, or rejected
            $table->timestamps(); // Created and updated timestamps

            // Indexes for faster querying
            $table->index(['employee_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
