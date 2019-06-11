<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edifice extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function commonAreas()
    {
        return $this->hasMany('App\CommonArea');
    }
}
