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
        Schema::create('komputers', function (Blueprint $table) {
            $table->id();
            $table->string('ruangan');
            $table->enum('unit', ['PC Build Up', 'All In One', 'Mini PC']);
            $table->string('brand')->nullable();
            $table->string('processor')->nullable();
            $table->string('ram')->nullable();
            $table->string('os')->nullable();
            $table->enum('storage_type', ['SSD', 'HDD'])->nullable();
            $table->string('storage_capacity')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('tahun')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komputers');
    }
};
