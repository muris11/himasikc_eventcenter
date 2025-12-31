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
        // Create event_categories table
        Schema::create('event_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create post_categories table
        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add event_category_id to events table
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_category_id')->nullable()->after('category_id');
            $table->foreign('event_category_id')->references('id')->on('event_categories')->onDelete('set null');
        });

        // Add post_category_id to posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('post_category_id')->nullable()->after('category_id');
            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['post_category_id']);
            $table->dropColumn('post_category_id');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['event_category_id']);
            $table->dropColumn('event_category_id');
        });

        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('event_categories');
    }
};
