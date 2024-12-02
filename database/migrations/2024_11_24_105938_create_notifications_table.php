<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['leave_approval', 'reminder', 'alert', 'announcement'])->default('reminder');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            // Indexes for better performance
            $table->index('user_id');
            $table->index('is_read');
        });

        // Add table comment only if the database supports it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE notifications COMMENT = 'Stores notifications for users such as leave approvals, reminders, and alerts.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
