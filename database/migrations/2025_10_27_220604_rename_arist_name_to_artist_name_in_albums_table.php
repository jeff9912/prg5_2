<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->renameColumn('arist_name', 'artist_name');
        });
    }

    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->renameColumn('artist_name', 'arist_name');
        });
    }
};
