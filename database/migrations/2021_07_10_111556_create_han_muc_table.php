<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHanMucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HanMuc', function (Blueprint $table) {
            $table->char('ID_KhoaPB', 10);
            $table->unsignedBigInteger('ID_VPP');
            $table->integer('HanMucDaSuDung')->default(0);
            $table->integer('HanMucToiDa');
            $table->dateTime('NgayBatDau');

            $table->primary(['ID_KhoaPB', 'ID_VPP']);
            $table->foreign('ID_KhoaPB')->references('ID')->on('KhoaPhongBan');
            $table->foreign('ID_VPP')->references('ID')->on('VatTu');
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
        Schema::dropIfExists('HanMuc');
    }
}
