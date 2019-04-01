<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * UserAttributes
 *
 * @mixing Eloquent
 */
class UserAttributes extends Model
{
    //

    protected $table = 'user_attributes';

    public $primaryKey = 'id';

    public $user_id = 'user_id';
    public $timestamps = true;

    public function user() {

        return $this->belongsTo('App\User');
    }



}
