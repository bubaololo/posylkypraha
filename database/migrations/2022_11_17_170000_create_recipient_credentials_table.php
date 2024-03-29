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
            $table->tinyText('title')->nullable();
            $table->tinyText('name');
            $table->tinyText('surname');
            $table->text('email')->nullable();
            $table->tinyText('tel')->nullable();
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
        Schema::dropIfExists('recipient_credentials');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
