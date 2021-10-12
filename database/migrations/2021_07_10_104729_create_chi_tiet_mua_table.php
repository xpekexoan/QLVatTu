<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietMuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietMua', function (Blueprint $table) {
            $table->char('ID_Phieu', 10);
            $table->unsignedBigInteger('ID_VatTu');
            $table->integer('SoLuong');
            $table->decimal('Gia', 10, 0)->nullable();

            $table->primary(['ID_Phieu', 'ID_VatTu']);
            $table->foreign('ID_Phieu')->references('ID')->on('PhieuDeNghi');
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
        Schema::dropIfExists('ChiTietMua');
    }
}
