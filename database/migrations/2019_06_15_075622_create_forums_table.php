<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->bigInteger('user_id')->unsigned(); //tipe integernya harus sama jika di table user tipe integernya big maka di table foreign yg lain harus big, bigIncrements() = bigInteger()
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
        Schema::dropIfExists('forums');
    }
}
