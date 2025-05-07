<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('additional_file')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('additional_file');
        });
    }
    
};
