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
}
