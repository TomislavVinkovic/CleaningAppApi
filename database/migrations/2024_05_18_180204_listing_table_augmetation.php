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
        Schema::table('listings', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->string('oib');

            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('oib');

            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');

            $table->dropColumn('type');

            $table->dropTimestamps();
        });
    }
};
