<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function commonArea()
    {
        return $this->belongsTo('App\CommonArea');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
