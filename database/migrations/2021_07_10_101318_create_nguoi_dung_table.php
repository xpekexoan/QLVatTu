<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoiDungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NguoiDung', function (Blueprint $table) {
            $table->char('ID', 10);
            $table->string('HoTen')->nullable();
            $table->date('NgaySinh')->nullable();
            $table->char('CMND', 9)->nullable();
            $table->string('SDT', 10)->nullable();
            $table->string('Email')->nullable();
            $table->string('TaiKhoan', 100);
            $table->string('MatKhau', 80);
            $table->tinyInteger('LoaiTK');
            $table->primary('ID');
            $table->rememberToken();
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
        Schema::dropIfExists('NguoiDung');
    }
}
