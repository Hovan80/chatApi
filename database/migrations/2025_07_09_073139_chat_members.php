<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("chat_members", function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('chat_id')->constrained('chats', 'id');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_members');
    }
};
