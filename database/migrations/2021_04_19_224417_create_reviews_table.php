<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('course');
            $table->integer('tuition');
            $table->integer('purpose');
            $table->date('when_start');
            $table->date('when_end');
            $table->boolean('at_school');
            //st = satisfactionの意
            $table->integer('st_tuition');
            $table->integer('st_term');
            $table->integer('st_curriculum');
            $table->integer('st_mentor');
            $table->integer('st_support');
            $table->integer('st_staff');
            $table->integer('total_judg');
            $table->string('title');
            $table->text('report');
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
