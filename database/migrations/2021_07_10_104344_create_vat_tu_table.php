<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVatTuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VatTu', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('Ten');
            $table->string('DonViTinh', 20);
            $table->string('Phong')->nullable();
            $table->tinyInteger('LoaiVT');
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
        Schema::dropIfExists('VatTu');
    }
}
