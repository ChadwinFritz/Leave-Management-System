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
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->unique(); // Unique name for the department
            $table->string('description')->nullable(); // Optional department description
            $table->unsignedBigInteger('user_id')->nullable(); // Reference to the user (supervisor)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status of the department
            $table->timestamps(); // Created and updated timestamps

            // Foreign key referencing the users table (instead of employees)
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            // Indexing
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
