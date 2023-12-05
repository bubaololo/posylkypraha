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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_num');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('credential_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedDecimal('total', $precision = 8, $scale = 2)->default(0);
            $table->unsignedDecimal('subtotal', $precision = 8, $scale = 2)->default(0);
            $table->unsignedDecimal('delivery_cost', $precision = 8, $scale = 2)->default(0);
            $table->boolean('paid')->default(0);
            $table->enum('delivery', ['post', 'sdek']);
            $table->text('comment')->nullable();
            $table->text('track')->nullable();
            $table->enum('status', ['в обработке', 'отправлен'])->default('в обработке');
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
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
