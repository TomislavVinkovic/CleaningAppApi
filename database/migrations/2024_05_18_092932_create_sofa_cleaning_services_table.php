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
        Schema::create('sofa_cleaning_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('no_seats');
            $table->timestamps();

            $table->uuid('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sofa_cleaning_services');
    }
};
