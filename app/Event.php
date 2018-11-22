<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['user_id', 'title', 'color', 'start_date', 'end_date', 'description', 'comment', 'participants'];
}
