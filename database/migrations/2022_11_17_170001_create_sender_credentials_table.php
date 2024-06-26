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
        Schema::create('sender_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->onUpdate('cascade');
            $table->tinyText('title')->nullable();
            $table->tinyText('name');
            $table->tinyText('surname');
            $table->tinyText('city');
            $table->tinyText('address');
            $table->tinyText('postal_code');
            $table->tinyText('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sender_credentials');
    }
};
