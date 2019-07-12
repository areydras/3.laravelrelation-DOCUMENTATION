<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passports', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('no_passport');
            $table->bigInteger('user_id')->unsigned(); //tipe integernya harus sama jika di table user tipe integernya big maka di table foreign yg lain harus big, bigIncrements() = bigInteger(). dan foreign harus unsigned
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //memberitahu bahwa user_id adalah foreign key, dan menyambungkan ke id, ditable users, dan bertipe delete cascade(saat user dihapus maka passport yg berelasi akan terhapus)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passports');
    }
}
