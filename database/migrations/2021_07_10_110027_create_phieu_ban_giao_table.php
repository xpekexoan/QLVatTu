<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhieuBanGiaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PhieuBanGiao', function (Blueprint $table) {
            $table->char('ID', 10);
            $table->char('ID_PhieuDN', 10);
            $table->char('ID_NVCSVC', 10);
            $table->char('ID_NguoiXN', 10)->nullable(); 
            $table->dateTime('NgayBanGiao')->nullable();

            $table->primary('ID');
            $table->foreign('ID_PhieuDN')->references('ID')->on('PhieuDeNghi');
            $table->foreign('ID_NVCSVC')->references('ID')->on('NguoiDung');
            $table->foreign('ID_NguoiXN')->references('ID')->on('NguoiDung');

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
        Schema::dropIfExists('PhieuBanGiao');
    }
}
