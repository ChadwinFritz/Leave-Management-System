<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTeamReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->date('report_date');
            $table->decimal('performance_score', 5, 2); // Performance score (out of 5, two decimal places)
            $table->decimal('attendance_percentage', 5, 2); // Attendance percentage (out of 100, two decimal places)
            $table->decimal('leave_percentage', 5, 2); // Leave percentage (out of 100, two decimal places)
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            // Adding indexes for performance and report date queries
            $table->index('team_id');
            $table->index('report_date');
        });

        // Optional: Adding a table comment, only for databases that support it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE team_reports COMMENT = 'Table for storing performance, attendance, and leave reports for teams.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_reports');
    }
}
