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
        Schema::create('edit_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no');
            $table->string('table_name');
            $table->unsignedBigInteger('accreditation_no');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('editor_id')->constrained('users');
            $table->timestamp('edited_at');
            $table->text('editor_remarks')->nullable();
            $table->foreignId('approver_id')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('approver_remarks')->nullable();
            $table->string('file_upload')->nullable();
            $table->timestamps();

            // Index for faster queries
            $table->index(['table_name', 'reference_no', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edit_requests');
    }
};
