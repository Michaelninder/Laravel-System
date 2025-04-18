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
        Schema::create('forums', function (Blueprint $table) {
		    $table->id();
		    $table->uuid('uuid')->unique();
		    $table->string('name');
		    $table->text('description')->nullable();
		    $table->boolean('is_locked')->default(false);
		    $table->integer('order_index')->default(0);
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
        Schema::dropIfExists('forums');
    }
};
