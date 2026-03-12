<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Step 1: Create the house table WITHOUT the foreign key first
        Schema::create('house', function (Blueprint $table) {

            // house_id int(11) AUTO_INCREMENT PRIMARY KEY
            $table->increments('house_id');

            // member_id — plain unsigned int, no foreign key yet
            $table->unsignedInteger('member_id');

            // address varchar(100)
            $table->string('address', 100)->default('');

            // fee decimal(10,0)
            $table->decimal('fee', 10, 0)->default(0);

            // gender tinyint — 0=Any, 1=Male only, 2=Female only
            $table->tinyInteger('gender')->default(0);

            // roomtype varchar(50)
            $table->string('roomtype', 50)->default('');

            // no_avaliablity — keeping your original spelling exactly
            $table->integer('no_avaliablity')->default(0);

            // create_date datetime — auto fills on insert
            $table->dateTime('create_date')->useCurrent();

            // update_date datetime — auto fills on insert and update
            $table->dateTime('update_date')->useCurrent()->useCurrentOnUpdate();

            // description text
            $table->text('description')->nullable();
        });

        // Step 2: Now add the foreign key AFTER the table is created
        // This avoids any race condition with the member table
        Schema::table('house', function (Blueprint $table) {
            $table->foreign('member_id')
                ->references('member_id')
                ->on('member')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Drop foreign key first, then drop the table
        Schema::table('house', function (Blueprint $table) {
            $table->dropForeign(['member_id']);
        });

        Schema::dropIfExists('house');
    }
};