<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id'); // Primary key
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->boolean('has_limit')->default(false);
            $table->integer('limit')->nullable();
            
            // Add this line to create employee_id as a foreign key and make it nullable
            $table->unsignedInteger('employee_id')->nullable(); // Make employee_id nullable
            
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
        Schema::dropIfExists('leave_types');
    }
}
