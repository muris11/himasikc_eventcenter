<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing participant_type values to match new format
        DB::table('events')->where('participant_type', 'student')->update(['participant_type' => 'mahasiswa']);
        DB::table('events')->where('participant_type', 'public')->update(['participant_type' => 'umum']);
        // 'all' remains the same
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert participant_type values back to old format
        DB::table('events')->where('participant_type', 'mahasiswa')->update(['participant_type' => 'student']);
        DB::table('events')->where('participant_type', 'umum')->update(['participant_type' => 'public']);
        // 'all' remains the same
    }
};
