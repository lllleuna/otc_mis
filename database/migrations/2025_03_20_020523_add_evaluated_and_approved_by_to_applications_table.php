<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('evaluated_by')->nullable()->after('status');
            $table->unsignedBigInteger('approved_by')->nullable()->after('evaluated_by');

            // If you have users table
            $table->foreign('evaluated_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['evaluated_by']);
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['evaluated_by', 'approved_by']);
        });
    }
};
