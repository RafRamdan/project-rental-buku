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
        Schema::table('books', function (Blueprint $table) {
            $table->date('publication_date')->nullable()->after('status');
            $table->string('publisher', 225)->after('title');
            $table->integer('page')->length(100)->nullable()->after('title');
            $table->text('description')->nullable()->after('title');
            $table->string('author', 255)->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'publication_date')) {
                $table->dropColumn('publication_date');
            }
            if (Schema::hasColumn('books', 'publisher')) {
                $table->dropColumn('publisher');
            }
            if (Schema::hasColumn('books', 'page')) {
                $table->dropColumn('page');
            }
            if (Schema::hasColumn('books', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('books', 'author')) {
                $table->dropColumn('author');
            }
        });
    }
};
