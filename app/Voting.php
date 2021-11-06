<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $guarded = [];
    protected $table = 'voting';
    protected $primaryKey = ['choice_id', 'user_id'];
    public $incrementing = false;
}
