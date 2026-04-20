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
        Schema::table('book_requests', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('book_id')->constrained()->onDelete('cascade');
            $table->dropColumn('student_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_requests', function (Blueprint $table) {
            $table->string('student_name')->nullable()->after('user_id');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
