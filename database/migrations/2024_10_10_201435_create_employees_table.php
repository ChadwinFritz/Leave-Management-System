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
            $table->increments('id'); // Primary key
            
            // Basic employee information
            $table->string('name'); // Full name of the employee
            $table->string('surname');
            $table->string('email')->unique(); // Email address of the employee
            $table->string('phone')->nullable(); // Phone number
            $table->string('address')->nullable(); // Address of the employee
            $table->date('hire_date')->nullable(); // Hiring date
            
            // Foreign key to users table
            $table->unsignedInteger('user_id')->nullable(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Foreign key to department table
            $table->unsignedInteger('department_id')->nullable(); 
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

            // Foreign key to duty table
            $table->unsignedInteger('duty_id')->nullable(); 
            $table->foreign('duty_id')->references('id')->on('duties')->onDelete('set null');

            // Employment-related fields
            $table->string('employee_code')->unique(); // Unique code for the employee
            $table->string('employment_status')->default('active'); // Status (active, resigned, etc.)

            // Additional notes
            $table->text('notes')->nullable(); // Additional notes for the employee

            // Timestamps
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
        Schema::dropIfExists('employees');
    }
}
