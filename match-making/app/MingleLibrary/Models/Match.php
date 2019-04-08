<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    protected $table = 'matches';

    public $primaryKey = 'id';

    public $timestamps = 'true';

}
