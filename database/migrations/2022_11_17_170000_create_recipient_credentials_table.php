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
        Schema::create('recipient_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->onUpdate('cascade');
            $table->tinyText('name');
            $table->tinyText('surname')->nullable();
            $table->tinyText('middle_name')->nullable();
            $table->text('region')->nullable();
            $table->text('district')->nullable();
            $table->text('city');
            $table->text('street');
            $table->text('home')->nullable();
            $table->text('building')->nullable();
            $table->text('apartment')->nullable();
            $table->tinyText('postal_code');
            $table->text('email')->nullable();
            $table->text('comment')->nullable();
            $table->tinyText('tel')->nullable();
            $table->tinyText('whatsapp')->nullable();
            $table->tinyText('telegram')->nullable();
            $table->text('last_ip')->nullable();
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
        Schema::dropIfExists('recipient_credentials');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
