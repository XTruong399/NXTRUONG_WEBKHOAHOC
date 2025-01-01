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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('order_id');  
            $table->unsignedBigInteger('Pro_id'); 
            $table->string('user_name')->nullable();
            $table->integer('quantity');  
            $table->decimal('price', 15, 2); 
            $table->decimal('total_price', 15, 2); 
            $table->timestamps();  
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('Pro_id')->references('Pro_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
