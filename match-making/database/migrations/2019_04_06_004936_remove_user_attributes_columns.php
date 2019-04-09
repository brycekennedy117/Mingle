<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserAttributesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_attributes', function (Blueprint $table) {
            //
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
            $table->dropColumn('suburb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_attributes', function (Blueprint $table) {
            //
        });
    }
}
