<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    //
    protected $table = 'postcodes';

    public $primaryKey = 'id';

    public $timestamps = false;

}
