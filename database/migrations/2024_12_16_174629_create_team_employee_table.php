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
        Schema::create('team_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id'); // Foreign key for teams table
            $table->unsignedBigInteger('employee_id'); // Foreign key for employees table
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            // Ensure that each team-employee pair is unique
            $table->unique(['team_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_employee');
    }
};
