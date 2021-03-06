<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    protected $table = 'matches';

    public $primaryKey = 'id';

    public $timestamps = 'true';

    public function user1() {
        return $this->belongsTo('App\User', 'user_id_1');
    }

    public function user2() {
        return $this->belongsTo('App\User', 'user_id_2');
    }

}
