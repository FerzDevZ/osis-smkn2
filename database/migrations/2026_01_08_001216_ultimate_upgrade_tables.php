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
        // 1. Members Table (Organization Structure)
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('period')->default('2023/2024');
            $table->string('department')->comment('BPH, Sekbid 1, etc');
            $table->string('photo_path')->nullable();
            $table->string('instagram_url')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // 2. Downloads Table (Digital Archive)
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->string('category')->default('Umum');
            $table->integer('download_count')->default(0);
            $table->timestamps();
        });

        // 3. Update Events Table (Progress Tracking & Featured)
        Schema::table('events', function (Blueprint $table) {
            $table->integer('progress')->default(0)->after('description');
            $table->boolean('is_featured')->default(false)->after('is_published');
            $table->string('category')->nullable()->after('location');
        });

        // 4. Update Posts Table (Blog Type)
        Schema::table('posts', function (Blueprint $table) {
            $table->string('type')->default('news')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
        Schema::dropIfExists('downloads');
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['progress', 'is_featured', 'category']);
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
