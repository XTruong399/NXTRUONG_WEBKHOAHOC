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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->string('user_name')->nullable()->change();
            $table->decimal('total_price', 15, 2); 
            $table->string('status')->default('pending'); 
            $table->text('note')->nullable(); 
            $table->timestamps(); 
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
