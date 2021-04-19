<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followings', function (Blueprint $table) {
            $table->unsignedBigInteger('follower_user_id');
            $table->unsignedBigInteger('poster_id');
            $table->unsignedBigInteger('followed_review_id');
            $table->timestamp('created_at');
            //外部キー制約
            $table->foreign('follower_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('poster_id')->references('id')->on('users')->onDolete('cascade');
            $table->foreign('followed_review_id')->references('id')->on('reviews')->onDelete('cascade');
            //複合主キーとして設定
            $table->primary(['follower_user_id', 'followed_review_id'])->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followings');
    }
}
