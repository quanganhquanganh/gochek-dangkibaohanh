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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('method'); // HTTP method (GET, POST, etc.)
            $table->string('endpoint'); // API endpoint
            $table->text('request_payload')->nullable(); // Request payload
            $table->text('response_payload')->nullable(); // Response payload
            $table->integer('status_code'); // HTTP response status code
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
