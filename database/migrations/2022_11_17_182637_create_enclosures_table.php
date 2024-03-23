<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enclosures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parcel_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->text('description');
            $table->integer('weight_kg')->nullable();
            $table->integer('weight_g')->default(0);
            $table->integer('quantity')->default(1);
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('enclosures');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
