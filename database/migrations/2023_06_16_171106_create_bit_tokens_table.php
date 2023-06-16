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
        Schema::create('bit_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bitcoin_id')->references('id')->on('bitcoins');
            $table->string('platform',55);
            $table->string('token',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bit_tokens');
    }
};
