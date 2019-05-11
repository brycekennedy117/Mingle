<?php

namespace App\MingleLibrary\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    public $primaryKey = 'id';

    protected $fillable = [
        'sender_id', 'receiver_id', 'content'
    ];

    public function sender() {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo('App\User', 'receiver_id');
    }
}
