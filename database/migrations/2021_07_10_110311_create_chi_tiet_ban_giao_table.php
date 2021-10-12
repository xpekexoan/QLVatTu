<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietBanGiaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietBanGiao', function (Blueprint $table) {
            $table->char('ID_Phieu', 10);
            $table->unsignedBigInteger('ID_VatTu');
            $table->integer('SoLuong');

            $table->primary(['ID_Phieu', 'ID_VatTu']);
            $table->foreign('ID_Phieu')->references('ID')->on('PhieuBanGiao');
            $table->foreign('ID_VatTu')->references('ID')->on('VatTu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ChiTietBanGiao');
    }
}
