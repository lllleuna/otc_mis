<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->boolean('has_letter_request')->default(false);
            $table->boolean('has_cda_cert')->default(false);
            $table->boolean('has_orcr_15_units')->default(false);
            $table->boolean('has_bank_cert')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'has_letter_request',
                'has_cda_cert',
                'has_orcr_15_units',
                'has_bank_cert',
            ]);
        });
    }
};
