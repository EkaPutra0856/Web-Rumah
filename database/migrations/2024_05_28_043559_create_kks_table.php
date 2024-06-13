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
        Schema::create('kks', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('admin_wilayahs_id')->constrained()->onDelete('cascade');
            // $table->foreignId('rumahs_id')->constrained()->onDelete('cascade');
            $table->string('nokk')->unique();
            $table->string('namakk');
            $table->integer('anggota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kks');
    }
};
