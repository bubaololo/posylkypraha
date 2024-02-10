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
        Schema::create('user_parcel', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('parcel_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['user_id', 'parcel_id']);
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
        Schema::dropIfExists('user_parcel');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
};
