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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->onUpdate('cascade');
            $table->text('title')->nullable();
            $table->tinyText('postal_code');
            $table->text('admin_area')->nullable();
            $table->text('region');
            $table->text('city');
            $table->text('street');
            $table->text('house');
            $table->text('building')->nullable();
            $table->text('apartment')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
