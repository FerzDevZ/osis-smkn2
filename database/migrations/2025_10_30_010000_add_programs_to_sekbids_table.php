<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sekbids', function (Blueprint $table) {
            $table->json('programs')->nullable()->after('instagram_url');
        });
    }

    public function down(): void
    {
        Schema::table('sekbids', function (Blueprint $table) {
            $table->dropColumn('programs');
        });
    }
};


