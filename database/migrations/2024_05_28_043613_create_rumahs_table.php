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
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            
            // $table->foreignId('wilayah_id')->constrained()->onDelete('cascade');
            $table->string('norumah');
            $table->string('alamat');
            $table->string('luas');
            $table->string('status');
            $table->string('tahun');
            $table->string('renov');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumahs');
    }
};
