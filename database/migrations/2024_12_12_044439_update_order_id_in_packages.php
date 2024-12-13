<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderIdInPackages extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            // Đổi kiểu dữ liệu của order_id thành int
            $table->integer('order_id')->nullable()->change();

            // Thêm khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            // Xóa khóa ngoại
            $table->dropForeign(['order_id']);

            // Đổi kiểu dữ liệu của order_id nếu cần
            $table->unsignedBigInteger('order_id')->nullable()->change();
        });
    }
}
