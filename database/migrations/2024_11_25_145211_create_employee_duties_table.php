<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEmployeeDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_duties', function (Blueprint $table) {
            // Composite Primary Key
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('duty_id');
            $table->dateTime('assigned_at');
            $table->timestamps(); // For created_at and updated_at columns

            // Foreign keys with onDelete actions
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');  // Delete duties if employee is deleted
            $table->foreign('duty_id')->references('id')->on('duties')->onDelete('cascade');  // Delete relationship if duty is deleted

            // Primary key
            $table->primary(['employee_id', 'duty_id']);

            // Indexes for employee_id and duty_id for optimized query performance
            $table->index('employee_id');
            $table->index('duty_id');
        });

        // Adding table comment for databases that support it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE employee_duties COMMENT = 'Table to track duties assigned to employees with timestamp of assignment.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_duties');
    }
}
