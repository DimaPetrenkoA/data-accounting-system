<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire', function (Blueprint $table) {
            $table->id();
            $table->string('fio');
            $table->string('age');
            $table->string('gender');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('actual_address')->nullable();
            $table->text('citizenship')->nullable();
            $table->text('position')->nullable();
            $table->string('currency')->nullable();
            $table->string('start_work')->nullable();
            $table->string('now_work')->nullable();
            $table->text('ins_name')->nullable();
            $table->text('company_position')->nullable();
            $table->text('company_about')->nullable();
            $table->string('education_lvl')->nullable();
            $table->string('language')->nullable();
            $table->string('about_me')->nullable();
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
        Schema::dropIfExists('questionnaire');
    }
}
