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
        //
        Schema::create('warranty_nhanhvn_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('barcode');
            $table->string('name')->comment('Tên Sản Phẩm');
            $table->integer('duration')->comment('Thời gian bảo hành');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('warranty_nhanhvn_types');
    }
};
