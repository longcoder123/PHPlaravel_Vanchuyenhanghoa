<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRegisteredToVehiclesTable extends Migration
{
    /**
     * Chạy migration để thêm cột mới.
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->boolean('is_registered')->default(false)->after('license_plate'); // Thêm cột với giá trị mặc định là false
        });
    }

    /**
     * Rollback migration để xóa cột mới.
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('is_registered');
        });
    }
}
