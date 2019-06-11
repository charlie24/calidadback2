<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation');
    }
}
