<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKhoaphongbanToNguoidungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('NguoiDung', function (Blueprint $table) {
            $table->char('ID_KhoaPB', 10)->nullable();

            $table->foreign('ID_KhoaPB')->references('ID')->on('KhoaPhongBan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('NguoiDung', function (Blueprint $table) {
            $table->dropForeign(['ID_KhoaPB']);
            $table->dropColumn('ID_KhoaPB');
        });
    }
}
