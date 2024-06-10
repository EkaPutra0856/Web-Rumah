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
        Schema::table('rumahs', function (Blueprint $table) {
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
        });
        Schema::table('kks', function (Blueprint $table) {
            $table->foreignId('rumah_id')->constrained()->onDelete('cascade');
            $table->foreignId('regional_admins_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation');
    }
};
