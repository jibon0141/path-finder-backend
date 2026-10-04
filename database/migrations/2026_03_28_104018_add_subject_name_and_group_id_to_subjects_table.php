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
        Schema::table('subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('subjects', 'subject_name')) {
                $table->string('subject_name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('subjects', 'group_id')) {
                $table->unsignedBigInteger('group_id')->nullable()->after('subject_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            if (Schema::hasColumn('subjects', 'group_id')) {
                $table->dropColumn('group_id');
            }
            if (Schema::hasColumn('subjects', 'subject_name')) {
                $table->dropColumn('subject_name');
            }
        });
    }
};
