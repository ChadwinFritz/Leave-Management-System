<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Task ID
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Optional task description
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending'); // Task status
            $table->unsignedBigInteger('user_id')->nullable(); // User ID of the person who created the task
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            // Index for user_id to optimize queries by user
            $table->index('user_id');
        });

        // Adding table comment, only for databases that support it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE tasks COMMENT = 'Table for tracking tasks assigned to users, with status, description, and timestamps.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
