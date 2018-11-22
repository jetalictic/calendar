<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public $timestamps = false;
    protected $table = 'tags';
    protected $fillable = ['event_id', 'sender_user_id', 'receiver_user_id'];
}
