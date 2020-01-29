<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsInSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections_in_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('section_id');
            $table->integer('subject_id');
            $table->integer('year_id');
            $table->string('date');
            $table->time('startTime');
            $table->time('endTime');
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
        Schema::dropIfExists('sections_in_subjects');
    }
}
