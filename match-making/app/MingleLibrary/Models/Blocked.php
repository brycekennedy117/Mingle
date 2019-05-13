<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

class Blocked extends Model
{
    protected $table = 'blockeds';

    public $primaryKey = 'id';

    public $timestamps = 'true';

    public function user1() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function user2() {
        return $this->belongsTo('App\User', 'blocked_id');
    }
}
