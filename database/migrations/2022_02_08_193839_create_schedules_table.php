<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', static function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id');
            $table->integer('day');
            $table->integer('group_id');
            $table->integer('classroom');
            $table->integer('building');
            $table->integer('type_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('week_num')->default(null);
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
