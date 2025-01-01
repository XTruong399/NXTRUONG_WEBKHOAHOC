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
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('cart_id');
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('Pro_id'); // ID sản phẩm
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
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
        // Sửa lại bảng cần xóa là 'carts' thay vì 'cart_items'
        Schema::dropIfExists('carts');
    }
};
