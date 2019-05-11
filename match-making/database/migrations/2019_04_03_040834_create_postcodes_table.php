<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;

use App\MingleLibrary\Models\Postcode;

class CreatePostcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('postcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('postcode');
            $table->string('suburb');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('state');
            $table->unique(array('postcode', 'suburb'));
        });

        $csvPath = Storage::disk('local')->path('postcodes_light.csv');
        $csv = array_map('str_getcsv', file($csvPath));

        foreach($csv as $index=>$pc) {
            if ($index > 0) {
                $postcode = new Postcode();
                $postcode->postcode = (int)$pc[0];
                $postcode->suburb = $pc[1];
                $postcode->latitude = (double)$pc[4];
                $postcode->longitude = (double)$pc[3];
                $postcode->state = $pc[2];
                $postcode->save();
            }
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcodes');
    }
}
