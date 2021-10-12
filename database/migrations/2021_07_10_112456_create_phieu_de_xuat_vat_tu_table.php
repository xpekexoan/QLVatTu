<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuDeXuatVatTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PhieuDeXuatVatTu', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->char('ID_NguoiYC', 10);
            $table->string('TenVatTu', 150);
            $table->dateTime('NgayDeXuat');
            $table->boolean('TrangThai');

            $table->foreign('ID_NguoiYC', 10)->references('ID')->on('NguoiDung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PhieuDeXuatVatTu');
    }
}
