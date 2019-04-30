<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $primaryKey = 'id';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Attributes() {

        return $this->hasOne('App\MingleLibrary\Models\UserAttributes');

    }
    public function matches(){

        return $this->hasMany('App\MingleLibrary\Models\Match', 'user_id_1')->orWhere('user_id_2', $this->id);
    }

    public function likes() {
        return $this->hasMany('App\MingleLibrary\Models\Like', 'user_id_1');
    }

    public function dislikes() {
        return $this->hasMany('App\MingleLibrary\Models\Ignored', 'user_id_1');
    }

    public function getID() {
        return $this->id;
    }

    public function messages(){

        return $this->hasMany('App\MingleLibrary\Models\Message', 'sender_id')->orWhere('receiver_id', $this->id);
    }

}
