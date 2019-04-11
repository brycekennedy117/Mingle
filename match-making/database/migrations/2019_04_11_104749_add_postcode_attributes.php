<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostcodeAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_attributes', function (Blueprint $table) {
            //
            $table->dropColumn(['postcode']);
        });
        Schema::table('user_attributes', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('postcode');
            $table->foreign(    'postcode')->references('id')->on('postcodes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('user_attributes', function (Blueprint $table) {
            //
            $table->dropForeign(['postcode']);
        });
    }
}
