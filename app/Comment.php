<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $primaryKey = ['user_id', 'ticket_id'];
    public $incrementing = false;
}
