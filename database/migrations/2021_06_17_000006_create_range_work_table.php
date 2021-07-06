<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangeWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('range_work', function (Blueprint $table) {
            $table->id();
            $table->string('ins_name');
            $table->string('ins_reg');
            $table->string('range_serial');
            $table->string('range_from');
            $table->string('range_to');
            $table->string('leader');
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
        Schema::dropIfExists('range_work');
    }
}
