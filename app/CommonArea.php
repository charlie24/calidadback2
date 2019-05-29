<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonArea extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
