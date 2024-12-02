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
            $table->unsignedBigInteger('manager_id')->nullable(); // Reference to the manager
            $table->unsignedBigInteger('supervisor_id')->nullable(); // Reference to the supervisor (fixed here)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status of the department
            $table->timestamps(); // Created and updated timestamps

            // Foreign keys
            $table->foreign('supervisor_id')->references('id')->on('employees')->nullOnDelete();

            // Indexing
            $table->index('supervisor_id');
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
