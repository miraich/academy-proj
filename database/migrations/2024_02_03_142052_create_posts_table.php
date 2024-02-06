<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('quote_author')->nullable();
            $table->string('img')->nullable();
            $table->string('video')->nullable();
            $table->string('link')->nullable();
            $table->string('views')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
