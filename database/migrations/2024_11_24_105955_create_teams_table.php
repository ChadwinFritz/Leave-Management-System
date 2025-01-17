<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id'); // Changed from 'supervisor_id' to 'user_id'
            $table->unsignedBigInteger('department_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key to 'users' table
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            // Indexes for better performance
            $table->index('user_id'); // Changed from 'supervisor_id' to 'user_id'
            $table->index('department_id');
        });

        // Add table comment only for databases that support it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE teams COMMENT = 'Table for teams with a user (supervisor) and department association.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
