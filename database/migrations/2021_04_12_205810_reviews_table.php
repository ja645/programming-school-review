<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('school_id')->constrained();
            $table->integer('course_id');
            $table->integer('purpose');
            $table->boolean('result');
            $table->string('language');
            $table->string('title');
            $table->integer('tuition');
            $table->integer('term');
            $table->integer('curriculum');
            $table->integer('mentor');
            $table->integer('support');
            $table->integer('staff');
            $table->integer('judgment');
            $table->string('report');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
