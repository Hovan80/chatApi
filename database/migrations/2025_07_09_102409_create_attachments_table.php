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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id()->primary();
            $table->bigInteger('message_id')->unsigned();
            $table->string('file_name');
            $table->integer('file_size')->unsigned();
            $table->string('file_extension');
            $table->string('storage_path');
            $table->bigInteger('uploader_id')->unsigned();
            $table->boolean('is_deleted');
            $table->timestamps();
            $table->foreign('message_id')->references('id')->on('messages');
            $table->foreign('uploader_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
