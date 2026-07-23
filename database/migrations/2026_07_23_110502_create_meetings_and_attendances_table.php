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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location')->default('Ruang Sekretariat OSIS');
            $table->datetime('meeting_date');
            $table->text('agenda')->nullable();
            $table->text('notes')->nullable();
            $table->string('passcode', 6);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('meeting_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('member_name');
            $table->string('position')->nullable();
            $table->timestamp('attended_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_attendances');
        Schema::dropIfExists('meetings');
    }
};
