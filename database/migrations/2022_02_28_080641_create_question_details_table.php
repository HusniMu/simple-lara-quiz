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
        Schema::create('question_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id');
            $table->mediumText('question');
            $table->mediumText('answer');
            $table->bigInteger('correct_answer')->nullable();
            $table->mediumText('argument');
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
        Schema::dropIfExists('question_details');
    }
};