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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(); // Full name of the user
            $table->string('email')->unique(); // Unique email address
            $table->integer('level')->default(0); // User role levels: 0 = User, 1 = Admin, 2 = Super Admin, 3 = Supervisor
            $table->string('username')->nullable()->unique(); // Unique username
            $table->string('password'); // Encrypted password
            $table->string('status')->default('pending'); // User status (e.g., 'pending', 'approved')
            $table->boolean('is_approved')->default(false); // Approval status by admin
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created and updated timestamps

            // Index for quick filtering
            $table->index(['level', 'status']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email serves as the primary key
            $table->string('token'); // Reset token
            $table->timestamp('created_at')->nullable(); // Timestamp for token creation
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary key for the session
            $table->foreignId('user_id')->nullable()->index()->constrained('users')->onDelete('cascade'); // FK to users table
            $table->string('ip_address', 45)->nullable(); // IP address of the session
            $table->text('user_agent')->nullable(); // User agent string of the session
            $table->longText('payload'); // Session payload
            $table->integer('last_activity')->index(); // Last activity timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
