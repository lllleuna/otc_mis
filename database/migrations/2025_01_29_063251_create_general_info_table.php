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
        // General Info Table
        Schema::create('general_info', function (Blueprint $table) {
            $table->id();
            $table->string('accreditation_no')->unique(); // Changed to string
            $table->string('name');
            $table->string('short_name');
            $table->date('accreditation_date');
            $table->string('accreditation_type');
            $table->string('cda_registration_no');
            $table->date('cda_registration_date');
            $table->string('common_bond_membership');
            $table->integer('membership_fee')->default(0);
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
            $table->string('contact_mid_initial')->nullable();
            $table->string('contact_suffix')->nullable();
            $table->string('employer_sss_reg_no')->nullable();
            $table->string('employer_pagibig_reg_no')->nullable();
            $table->string('employer_philhealth_reg_no')->nullable();
            $table->string('bir_tin')->nullable();
            $table->string('bir_tax_exemption_no')->nullable();
            $table->timestamps();
        });

        // Define all other tables with accreditation_no as a string foreign key
        $tables = [
            'membership', 'employment', 'units', 'franchises', 'cgs', 
            'governance', 'finances', 'grants_donations', 'scholarships', 
            'loans', 'businesses', 'cetos', 'trainings_seminars'
        ];

        foreach ($tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->id();
                $table->string('accreditation_no'); // Changed to string
                $table->year('entry_year');

                if ($tableName === 'membership') {
                    $table->integer('driver_male')->default(0);
                    $table->integer('driver_female')->default(0);
                    $table->integer('operator_investor_male')->default(0);
                    $table->integer('operator_investor_female')->default(0);
                    $table->integer('allied_workers_male')->default(0);
                    $table->integer('allied_workers_female')->default(0);
                    $table->integer('other_member_male')->default(0);
                    $table->integer('other_member_female')->default(0);
                    $table->integer('number_of_pwd')->default(0);
                    $table->integer('number_of_senior')->default(0);
                    $table->integer('total_members')->default(0);
                }
                if ($tableName === 'employment') {
                    $table->integer('drivers_probationary_male')->default(0);
                    $table->integer('drivers_probationary_female')->default(0);
                    $table->integer('drivers_regular_male')->default(0);
                    $table->integer('drivers_regular_female')->default(0);
                    $table->integer('management_probationary_male')->default(0);
                    $table->integer('management_probationary_female')->default(0);
                    $table->integer('management_regular_male')->default(0);
                    $table->integer('management_regular_female')->default(0);
                    $table->integer('allied_probationary_male')->default(0);
                    $table->integer('allied_probationary_female')->default(0);
                    $table->integer('allied_regular_male')->default(0);
                    $table->integer('allied_regular_female')->default(0);
                    $table->integer('total_employees')->default(0);
                }
                if ($tableName === 'units') {
                    $table->string('mode_of_service');
                    $table->string('type_of_unit');
                    $table->integer('cooperatively_owned')->default(0);
                    $table->integer('individually_owned')->default(0);
                }
                if ($tableName === 'franchises') {
                    $table->string('route');
                    $table->string('cpc_case_number');
                    $table->string('type_of_franchise');
                    $table->string('mode_of_service');
                    $table->string('type_of_unit');
                    $table->string('validity');
                    $table->string('remarks')->nullable();
                }
                if ($tableName === 'cgs') {
                    $table->integer('cgs_number');
                    $table->date('issuance_date');
                    $table->date('expiration_date');
                }
                if ($tableName === 'governance') {
                    $table->string('role_name', 50); 
                    $table->string('first_name', 100);
                    $table->string('middle_name', 100)->nullable();
                    $table->string('last_name', 100);
                    $table->string('suffix', 10)->nullable();
                    $table->date('term_start');
                    $table->date('term_end')->nullable();
                    $table->string('mobile_number', 11); // Philippine mobile number
                    $table->string('email')->unique();
                }
                if ($tableName === 'finances') {
                     // FINANCIAL ASPECT
                    $table->decimal('current_assets', 15, 2);  // Assets in currency (precision of 2 decimal points)
                    $table->decimal('noncurrent_assets', 15, 2);
                    $table->decimal('total_assets', 15, 2);
                    $table->enum('coop_type', ['Micro', 'Small', 'Medium', 'Large']);  // Coop type based on assets
                    $table->decimal('liabilities', 15, 2);
                    $table->decimal('members_equity', 15, 2);
                    $table->decimal('total_gross_revenues', 15, 2);
                    $table->decimal('total_expenses', 15, 2);
                    $table->decimal('net_surplus', 15, 2);
                    
                    // CAPITALIZATION
                    $table->decimal('initial_auth_capital_share', 15, 2);
                    $table->decimal('present_auth_capital_share', 15, 2);
                    $table->decimal('subscribed_capital_share', 15, 2);
                    $table->decimal('paid_up_capital', 15, 2);
                    $table->decimal('capital_build_up_scheme', 15, 2);

                    // DISTRIBUTION OF NET SURPLUS
                    $table->decimal('general_reserve_fund', 15, 2);
                    $table->decimal('education_training_fund', 15, 2);
                    $table->decimal('community_dev_fund', 15, 2);
                    $table->decimal('optional_fund', 15, 2);
                    $table->decimal('share_capital_interest', 15, 2); // Distribution of Divideds / Interest on share Capital
                    $table->decimal('patronage_refund', 15, 2);
                    $table->decimal('others', 15, 2);
                    $table->decimal('total', 15, 2);
                    $table->decimal('deficit_from_financial_aspect', 15, 2);
                }
                if ($tableName === 'grants_donations') {
                    $table->date('acquired_at');
                    $table->decimal('amount');
                    $table->string('source');
                    $table->string('remarks');
                }
                if ($tableName === 'scholarships') {
                    $table->string('course_taken');
                    $table->integer('beneficiary')->default(value: 0); // No. of Scholar Beneficiary
                    $table->string('remarks');
                }
                if ($tableName === 'loans') {
                    $table->string('financing_institution');
                    $table->date('acquired_at');
                    $table->decimal('amount', 15, 2);
                    $table->string('utilization');
                    $table->string('remarks');

                }
                if ($tableName === 'businesses') {
                    $table->enum('type', ['Proposed', 'Existing']);
                    $table->string('nature_of_business');
                    $table->decimal('starting_capital', 15, 2);
                    $table->decimal('capital_to_date', 15, 2);
                    $table->integer('years_of_existence');
                    $table->string('status');
                    $table->string('remarks');
                }
                if ($tableName === 'cetos') {
                    $table->integer('members_with');
                    $table->integer('members_without');
                    $table->integer('total');
        
                }
                if ($tableName === 'trainings_seminars') {
                    $table->string('title');
                    $table->date('start');
                    $table->date('end');
                    $table->integer('no_of_attendees');
                    $table->string('remarks');
        
                }

                $table->timestamps();
                $table->foreign('accreditation_no')->references('accreditation_no')->on('general_info')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_info');

        $tables = [
            'membership', 'employment', 'units', 'franchises', 'cgs', 
            'governance', 'finances', 'grants_donations', 'scholarships', 
            'loans', 'businesses', 'cetos', 'trainings_seminars'
        ];

        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};
