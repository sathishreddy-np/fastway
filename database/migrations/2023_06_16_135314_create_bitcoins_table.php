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
        Schema::create('bitcoins', function (Blueprint $table) {
            $table->id();
            $table->string('bitcoin_id',55);
            $table->string('symbol',55);
            $table->string('name',55);
            $table->string('platform',55)->nullable();
            $table->string('token',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitcoins');
    }
};
