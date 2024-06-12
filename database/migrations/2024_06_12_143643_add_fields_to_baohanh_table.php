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
        Schema::table('baohanhs', function (Blueprint $table) {
            //
            $table->string('date_of_birth')->nullable();
            $table->string('device')->nullable();
            $table->string('purpose_of_use')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baohanh', function (Blueprint $table) {
            //
            $table->dropColumn('date_of_birth');
            $table->dropColumn('device');
            $table->dropColumn('purpose_of_use');
        });
    }
};
