<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("ALTER TABLE application_status_histories MODIFY COLUMN status ENUM('new', 'saved', 'evaluated', 'approved', 'rejected', 'needs_info') NOT NULL");
        DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('new', 'saved', 'evaluated', 'approved', 'rejected', 'needs_info') NOT NULL");
    }

    public function down()
    {
        DB::statement("ALTER TABLE application_status_histories MODIFY COLUMN status ENUM('new', 'evaluated', 'approved', 'rejected', 'waiting', 'needs_info') NOT NULL");
        DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('new', 'evaluated', 'approved', 'rejected', 'waiting', 'needs_info') NOT NULL");
    }
};

