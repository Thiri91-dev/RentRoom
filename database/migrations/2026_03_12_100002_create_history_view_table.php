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
        Schema::create('history_view', function (Blueprint $table) {

            // view_id int(11) AUTO_INCREMENT PRIMARY KEY
            $table->increments('view_id');

            // member_id — which member viewed the house
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')
                ->references('member_id')
                ->on('member')
                ->onDelete('cascade');

            // remarks text — any notes about the viewing
            $table->text('remarks')->nullable();

            // create_date datetime — when they viewed it
            $table->dateTime('create_date')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_view');
    }
};
