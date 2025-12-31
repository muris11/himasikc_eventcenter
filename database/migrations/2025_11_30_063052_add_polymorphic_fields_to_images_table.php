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
        Schema::table('images', function (Blueprint $table) {
            // Add polymorphic relation columns and common image fields
            if (! Schema::hasColumn('images', 'imageable_id')) {
                $table->morphs('imageable');
            }

            if (! Schema::hasColumn('images', 'path')) {
                $table->string('path')->nullable();
            }

            if (! Schema::hasColumn('images', 'alt')) {
                $table->string('alt')->nullable();
            }

            if (! Schema::hasColumn('images', 'sort_order')) {
                $table->integer('sort_order')->nullable();
            }

            if (! Schema::hasColumn('images', 'disk')) {
                $table->string('disk')->default('public');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            if (Schema::hasColumn('images', 'imageable_id')) {
                $table->dropMorphs('imageable');
            }

            if (Schema::hasColumn('images', 'path')) {
                $table->dropColumn('path');
            }

            if (Schema::hasColumn('images', 'alt')) {
                $table->dropColumn('alt');
            }

            if (Schema::hasColumn('images', 'sort_order')) {
                $table->dropColumn('sort_order');
            }

            if (Schema::hasColumn('images', 'disk')) {
                $table->dropColumn('disk');
            }
        });
    }
};
