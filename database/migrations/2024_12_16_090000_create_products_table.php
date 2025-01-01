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
        if (!Schema::hasTable('products')) {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('Pro_id'); 
            $table->string('Pro_name'); 
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable(); 
            $table->decimal('price', 10, 2); 
            $table->decimal('discount_price', 10, 2)->nullable(); 
            $table->integer('stock')->default(0); 
            $table->boolean('bestseller')->default(0); 
            $table->boolean('popular')->default(0); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->unsignedBigInteger('cate_id'); 
            $table->timestamps(); 

            // Khóa ngoại
            $table->foreign('cate_id')->references('cate_id')->on('categories')->onDelete('cascade'); // Ràng buộc khóa ngoại
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
