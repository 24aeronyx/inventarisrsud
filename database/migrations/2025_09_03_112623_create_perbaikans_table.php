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
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->unsignedBigInteger('asset_id');
            $table->string('asset_type');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index(['asset_id', 'asset_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
