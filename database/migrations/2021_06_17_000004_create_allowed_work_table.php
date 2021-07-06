<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowedWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allowed_work', function (Blueprint $table) {
            $table->id();
            $table->string('ins_name');
            $table->string('ins_reg');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('actual_address')->nullable();
            $table->string('currency');
            $table->text('company_position');
            $table->text('company_about');
            $table->string('status');
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
        Schema::dropIfExists('allowed_work');
    }
}
