<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // First name of the employee
            $table->string('surname'); // Surname of the employee
            $table->string('email')->unique(); // Employee email, unique for each employee
            $table->string('phone')->nullable(); // Employee phone number (nullable)
            $table->string('address')->nullable(); // Employee address (nullable)
            $table->dateTime('hire_date')->nullable(); // Date the employee was hired
            $table->unsignedBigInteger('user_id'); // Foreign key for user table
            $table->unsignedBigInteger('department_id'); // Foreign key for department table
            $table->unsignedBigInteger('duty_id'); // Add this line for duty_id column
            $table->string('employee_code')->unique(); // Unique employee code
            $table->string('employment_status')->nullable(); // Status like "active", "inactive"
            $table->text('notes')->nullable(); // Optional field for extra notes about the employee
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('duty_id')->references('id')->on('duties')->onDelete('set null'); // Add this line for duty_id foreign key

            // Indexing for employee_code
            $table->index('employee_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
