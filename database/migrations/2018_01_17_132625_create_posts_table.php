<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Posts', function (Blueprint $table) {
            $table->increments('Po_Id');
            $table->integer('Po_Co_Id')->unsigned();
            $table->integer('Po_Us_Id')->unsigned();
            $table->mediumText('Po_Body');
            $table->timestamps();
        });
        Schema::table('Tbl_Posts', function($table) {
            $table->foreign('Po_Co_Id')->references('Co_Id')
                ->on('Tbl_Countries')->onDelete('cascade');
            $table->foreign('Po_Us_Id')->references('Us_Id')
                ->on('Tbl_Users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
