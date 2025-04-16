<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('support_messages', function (Blueprint $table) {
		    $table->id();
		    $table->uuid('uuid')->unique();
		    $table->uuid('ticket_uuid');
		    $table->uuid('user_uuid');
		    $table->text('message');
		    $table->timestamps();
		});
    }

    public function down(): void {
        Schema::dropIfExists('support_messages');
    }
};
