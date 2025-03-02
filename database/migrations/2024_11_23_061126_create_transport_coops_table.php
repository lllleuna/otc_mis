<?php

// drop this table

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
        Schema::create('transport_coops', function (Blueprint $table) {
            $table->id();
            $table->string('accreditation_no')->unique();
            $table->string('name');
            $table->string('short_name');
            $table->date('accreditation_date');
            $table->string('accreditation_type');
            $table->string('cda_registration_no');
            $table->date('cda_registration_date');
            $table->string('common_bond_membership');
            $table->integer('membership_fee');
            $table->string('area');
            $table->string('region');
            $table->string('city');
            $table->string('province');
            $table->string('barangay');
            $table->string('business_address');
            $table->string('email')->unique();
            $table->string('contact_no');
            $table->string('contact_firstname');
            $table->string('contact_lastname');
            $table->string('contact_mid_initial');
            $table->string('contact_suffix');
            $table->string('employer_sss_reg_no');
            $table->string('employer_pagibig_reg_no');
            $table->string('employer_philhealth_reg_no');
            $table->string('bir_tin');
            $table->string('bir_tax_exemption_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_coops');
    }
};
