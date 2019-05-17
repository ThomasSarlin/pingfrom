<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimpleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Users', function (Blueprint $table) {
            $table->increments('Us_Id');
            $table->string('Us_Name');
            $table->bigInteger('Us_Clicks');
            $table->integer('Us_Co_Id')->unsigned();
            $table->timestamps();
        }); 
        Schema::table('Tbl_Users', function($table) {
            $table->foreign('Us_Co_Id')->references('Co_Id')
                ->on('Tbl_Countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simple_users');
    }
}
