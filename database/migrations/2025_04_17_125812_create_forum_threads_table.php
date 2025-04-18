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
        Schema::create('forum_threads', function (Blueprint $table) {
		    $table->id();
		    $table->uuid('uuid')->unique();
		    $table->uuid('forum_uuid');
		    $table->uuid('user_uuid');
		    $table->string('title');
		    $table->boolean('is_pinned')->default(false);
		    $table->boolean('is_locked')->default(false);
		    $table->integer('views')->default(0);
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
        Schema::dropIfExists('forum_threads');
    }
};
