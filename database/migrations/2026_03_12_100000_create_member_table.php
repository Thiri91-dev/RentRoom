<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member', function (Blueprint $table) {

            // Primary key — matches your SQL: member_id int(11) AUTO_INCREMENT
            $table->increments('member_id');

            // type tinyint(4) — 0 = regular user, 1 = admin/owner
            $table->tinyInteger('type')->default(0);

            // name varchar(100)
            $table->string('name', 100);

            // email varchar(100) — used for login
            $table->string('email', 100)->unique();

            // password varchar(100) — we hash this in Laravel
            $table->string('password', 255);  // 255 for bcrypt hash

            // mobile_no varchar(100) — phone number
            $table->string('mobile_no', 100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
