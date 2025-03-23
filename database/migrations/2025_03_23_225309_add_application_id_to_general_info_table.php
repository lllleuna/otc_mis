<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('general_info', function (Blueprint $table) {
        $table->unsignedBigInteger('application_id')->nullable()->after('id');
        $table->foreign('application_id')->references('id')->on('applications')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('general_info', function (Blueprint $table) {
        $table->dropForeign(['application_id']);
        $table->dropColumn('application_id');
    });
}

};
