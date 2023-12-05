<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->onUpdate('cascade');
            $table->tinyText('name')->nullable();
            $table->tinyText('surname')->nullable();
            $table->tinyText('middle_name')->nullable();
            $table->text('address')->nullable();
            $table->text('email')->nullable();
            $table->text('apartment')->nullable();
            $table->text('last_ip')->nullable();
            $table->text('comment')->nullable();
            $table->tinyText('tel')->nullable();
            $table->tinyText('index')->nullable();
            $table->tinyText('whatsapp')->nullable();
            $table->tinyText('telegram')->nullable();
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
        Schema::dropIfExists('credentials');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
