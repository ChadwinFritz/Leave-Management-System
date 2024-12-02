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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('code')->unique(); // Unique identifier for leave types
            $table->string('name'); // Human-readable name of the leave type
            $table->boolean('has_limit')->default(false); // Indicates if this leave type has a limit
            $table->unsignedInteger('limit')->nullable(); // Limit for this leave type, nullable if has_limit is false
            $table->timestamps(); // Created and updated timestamps

            // Index for fast querying
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
