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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_code');
            $table->string('title');
            $table->string('slug', 255)->nullable();
            $table->string('author', 255);
            $table->string('publisher', 225);
            $table->date('publication_date')->nullable();
            $table->integer('page')->length(100)->nullable();
            $table->text('description')->nullable();
            $table->string('cover', 255)->nullable();
            $table->integer('stock');
            $table->string('status')->default('in stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
