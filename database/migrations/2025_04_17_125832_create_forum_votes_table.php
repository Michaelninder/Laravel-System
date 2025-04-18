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
        Schema::create('forum_votes', function (Blueprint $table) {
		    $table->id();
		    $table->uuid('uuid')->unique();
		    $table->uuid('comment_uuid');
		    $table->uuid('user_uuid');
		    $table->boolean('is_upvote');
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
        Schema::dropIfExists('forum_votes');
    }
};
