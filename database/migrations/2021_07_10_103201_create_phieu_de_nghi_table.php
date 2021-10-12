<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuDeNghiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PhieuDeNghi', function (Blueprint $table) {
            $table->char('ID', 10);
            $table->char('ID_NguoiDN', 10)->nullable(); 
            $table->char('ID_NVCSVC', 10)->nullable();
            $table->tinyInteger('LoaiPhieu');
            $table->dateTime('NgayLapPhieu')->nullable();
            $table->date('NgayDuKien')->nullable();
            $table->dateTime('NgayHoanThanh')->nullable();
            $table->tinyInteger('TrangThai');
            $table->string('GhiChu')->nullable();

            $table->primary('ID');
            $table->foreign('ID_NguoiDN')->references('ID')->on('NguoiDung');
            $table->foreign('ID_NVCSVC')->references('ID')->on('NguoiDung');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PhieuDeNghi');
    }
}
