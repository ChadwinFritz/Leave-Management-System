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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade'); // FK to employees with cascade delete
            $table->foreignId('leave_application_id')->constrained('leave_applications')->onDelete('cascade'); // FK to leave applications
            $table->decimal('total_leave', 8, 2); // Total leave days/hours
            $table->date('start_date'); // Start date of leave
            $table->date('end_date'); // End date of leave
            $table->boolean('start_half')->default(false); // Indicates if the start day is a half-day
            $table->boolean('end_half')->default(false); // Indicates if the end day is a half-day
            $table->date('on_date')->nullable(); // For one-day leave, nullable
            $table->dateTime('on_time')->nullable(); // For specific time-based leave, nullable
            $table->string('leave_type'); // Leave type code
            $table->timestamps(); // Created and updated timestamps

            // Add a foreign key for leave_type referencing leave_types table
            $table->foreign('leave_type')->references('code')->on('leave_types')->onDelete('restrict');

            // Indexes for performance
            $table->index(['employee_id', 'leave_application_id', 'leave_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
