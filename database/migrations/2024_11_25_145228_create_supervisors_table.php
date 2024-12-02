<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->timestamps(); // For created_at and updated_at columns

            // Foreign keys with onDelete actions
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // If user is deleted, delete the supervisor record
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');  // Set null if department is deleted
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');  // Set null if team is deleted

            // Indexes for faster querying
            $table->index('user_id');
            $table->index('department_id');
            $table->index('team_id');
        });

        // Adding table comment for databases that support it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE supervisors COMMENT = 'Table that tracks supervisors, linking them to users, departments, and teams.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisors');
    }
}
