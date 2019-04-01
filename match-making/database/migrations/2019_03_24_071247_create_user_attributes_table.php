<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->unique();
            $table->double('openness');
            $table->double('conscientiousness');
            $table->double('extraversion');
            $table->double('agreeableness');
            $table->double('neuroticism');
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('postcode');
            $table->string('suburb');
            $table->date('date_of_birth');
            $table->enum('gender', ['M', 'F']);
            $table->enum('interested_in', ['M', 'F', 'MF']);
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
        Schema::dropIfExists('user_attributes');
    }
}
