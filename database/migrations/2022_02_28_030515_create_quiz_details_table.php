<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id');
            $table->bigInteger('question_detail_id');
            $table->bigInteger('no');
            $table->mediumText('question');
            $table->mediumText('answer');
            $table->bigInteger('correct_answer');
            $table->bigInteger('user_answer')->nullable();
            $table->bigInteger('material_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_details');
    }
};