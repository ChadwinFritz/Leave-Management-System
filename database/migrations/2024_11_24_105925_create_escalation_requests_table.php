<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEscalationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalation_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('user_id'); // Changed from supervisor_id to user_id
            $table->text('reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->dateTime('date_requested');
            $table->timestamps();

            // Foreign keys
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('user_id')->references('id')->on('employees'); // Assuming user is also an employee

            // Indexes for better performance
            $table->index('employee_id');
            $table->index('user_id'); // Changed from supervisor_id to user_id
        });

        // Add table comment only if the database supports it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE escalation_requests COMMENT = 'Tracks escalation requests made by employees to users (supervisors or managers), including status and reasons.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escalation_requests');
    }
}
