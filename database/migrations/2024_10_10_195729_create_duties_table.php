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
        Schema::create('duties', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('code')->unique(); // Unique code for duty identification
            $table->string('name'); // Name of the duty
            $table->text('description')->nullable(); // Optional description of the duty
            $table->enum('status', ['active', 'inactive'])->default('active'); // Duty status, default to active
            $table->timestamps(); // Created and updated timestamps

            // Add indexing for faster lookups
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duties');
    }
};
