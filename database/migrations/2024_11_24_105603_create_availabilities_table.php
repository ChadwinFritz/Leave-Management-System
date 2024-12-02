<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->dateTime('available_from'); // Tracks when the availability starts
            $table->dateTime('available_to'); // Tracks when the availability ends
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();

            // Foreign key constraint linking to the employees table
            $table->foreign('employee_id')->references('id')->on('employees');

            // Index for employee_id for better lookup performance
            $table->index('employee_id');
        });

        // Add table comment only if the database supports it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE availabilities COMMENT = 'Stores employee availability data, tracking periods of availability or unavailability.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}
