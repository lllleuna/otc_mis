<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('change_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edit_request_id')->constrained()->onDelete('cascade');
            $table->string('column_name');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps();
            
            // Index for faster lookups
            $table->index(['edit_request_id', 'column_name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('change_items');
    }
};
