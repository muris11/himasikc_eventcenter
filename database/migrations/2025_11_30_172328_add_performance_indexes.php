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
        Schema::table('events', function (Blueprint $table) {
            // Index untuk queries yang sering digunakan
            $table->index(['is_active', 'created_at'], 'events_active_created_idx');
            $table->index(['date', 'is_active'], 'events_date_active_idx');
            $table->index('slug', 'events_slug_idx');
            $table->index('event_category_id', 'events_category_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            // Index untuk queries yang sering digunakan
            $table->index(['is_published', 'created_at'], 'posts_published_created_idx');
            $table->index('slug', 'posts_slug_idx');
            $table->index('post_category_id', 'posts_category_idx');
            $table->index('user_id', 'posts_user_idx');
        });

        Schema::table('visitors', function (Blueprint $table) {
            // Index untuk analytics queries
            $table->index('created_at', 'visitors_created_at_idx');
            $table->index(['created_at', 'ip_address'], 'visitors_date_ip_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex('events_active_created_idx');
            $table->dropIndex('events_date_active_idx');
            $table->dropIndex('events_slug_idx');
            $table->dropIndex('events_category_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_published_created_idx');
            $table->dropIndex('posts_slug_idx');
            $table->dropIndex('posts_category_idx');
            $table->dropIndex('posts_user_idx');
        });

        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex('visitors_created_at_idx');
            $table->dropIndex('visitors_date_ip_idx');
        });
    }
};
