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
        Schema::table('general_info', function (Blueprint $table) {
            $table->date('validity_date')->nullable()->after('accreditation_certificate_filename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_info', function (Blueprint $table) {
            $table->dropColumn('validity_date');
        });
    }
};
