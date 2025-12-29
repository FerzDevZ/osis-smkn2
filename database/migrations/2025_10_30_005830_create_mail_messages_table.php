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
        Schema::create('mail_messages', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_anonymous')->default(false);
            $table->string('student_name')->nullable();
            $table->string('class_name')->nullable();
            $table->string('contact')->nullable();
            $table->enum('category', ['saran', 'keluhan', 'umum'])->default('umum');
            $table->text('message');
            $table->enum('status', ['pending', 'reviewed', 'archived'])->default('pending');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_messages');
    }
};
