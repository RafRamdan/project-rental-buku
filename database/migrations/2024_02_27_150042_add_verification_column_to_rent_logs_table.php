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
        Schema::table('rent_logs', function (Blueprint $table) {
            $table->string('verification', 225)->after('actual_return_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rent_logs', function (Blueprint $table) {
            if (Schema::hasColumn('rent_logs', 'verification')) {
                $table->dropColumn('verification');
            }
        });
    }
};
