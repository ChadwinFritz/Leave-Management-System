<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Ensures no duplicate keys are inserted
            $table->text('value')->nullable()->default(''); // Default empty value
            $table->timestamps(); // Automatically handles created_at and updated_at

            // Index for better lookup performance on 'key'
            $table->index('key');
        });

        // Add table comment only if the database supports it
        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE system_settings COMMENT = 'Table to store configuration settings for the system.'");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
