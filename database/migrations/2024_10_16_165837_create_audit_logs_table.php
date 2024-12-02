<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('action');
            $table->string('ip_address', 45); // Support for both IPv4 and IPv6
            $table->text('description')->nullable(); // Optional detailed description of the action
            $table->timestamps(); // Timestamps will automatically create 'created_at' and 'updated_at'

            // Foreign key relationship
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes for quicker lookups
            $table->index('user_id');
            $table->index('ip_address');
        });

        // Add comment only if the database supports it (e.g., MySQL, PostgreSQL)
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE audit_logs COMMENT = 'Table to store audit logs for tracking user actions'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
}
