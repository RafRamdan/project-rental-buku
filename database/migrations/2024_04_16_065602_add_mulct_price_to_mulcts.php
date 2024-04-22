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
        Schema::table('mulcts', function (Blueprint $table) {
            $table->string('mulct_price', 255)->nullable()->after('mulct');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mulcts', function (Blueprint $table) {
            $table->dropColumn('mulct_price');
        });
    }
};
