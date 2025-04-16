<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('support_tickets', function (Blueprint $table) {
		    $table->id();
		    $table->uuid('uuid')->unique();
		    $table->uuid('user_uuid');
		    $table->string('subject');
		    $table->string('theme')->nullable();
		    $table->string('status')->default('open');
		    $table->timestamps();
		});
    }

    public function down(): void {
        Schema::dropIfExists('support_tickets');
    }
};
