<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // The employee requesting the leave
            $table->unsignedBigInteger('leave_application_id'); // Related leave application
            $table->date('request_date'); // Date the leave request was made
            $table->date('start_date'); // Leave start date
            $table->date('end_date'); // Leave end date
            $table->text('reason'); // Reason for the leave request
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status of the request
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('leave_application_id')->references('id')->on('leave_applications')->onDelete('cascade');

            // Indexes for faster querying
            $table->index('employee_id');
            $table->index('leave_application_id');
        });

        // Adding a table comment, only for databases that support it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE leave_requests COMMENT = 'Table for tracking leave requests made by employees, associated with leave applications.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}
