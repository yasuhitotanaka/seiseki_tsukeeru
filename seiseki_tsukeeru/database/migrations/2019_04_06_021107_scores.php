<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Scores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('janso_id');
            $table->integer('total_first_number');
            $table->integer('total_second_number');
            $table->integer('total_third_number');
            $table->integer('total_fourth_number');
            $table->integer('all_number');
            $table->float('total_income', 8, 2);
            $table->float('average_score', 3, 2);
            $table->integer('savings');
            $table->float('average_savings', 4, 2);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('modified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
