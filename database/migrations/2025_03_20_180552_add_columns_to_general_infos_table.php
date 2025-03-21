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
            $table->string('status')->nullable()->after('accreditation_no'); 
            $table->string('accreditation_certificate_filename')->nullable()->after('status');
            $table->string('cgs_filename')->nullable()->after('accreditation_certificate_filename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_info', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('accreditation_certificate_filename');
            $table->dropColumn('cgs_filename');
        });
    }
};
