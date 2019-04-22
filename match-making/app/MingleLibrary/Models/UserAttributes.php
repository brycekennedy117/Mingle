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

    protected $fillable = [
        'user_id', 'openness', 'conscientiousness', 'extraversion', 'agreeableness',
        'neuroticism', 'postcode', 'suburb', 'date_of_birth', 'gender', 'interested_in', 'latitude', 'longitude'
    ];

    public $primaryKey = 'id';

    public $timestamps = true;

    public function user() {

        return $this->belongsTo('App\User');
    }

    public function postcodeObject() {
        return $this->belongsTo('App\MingleLibrary\Models\Postcode', 'postcode');
    }
}
