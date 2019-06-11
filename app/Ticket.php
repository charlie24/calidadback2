<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function ticketStatus()
    {
        return $this->belongsTo('App\TicketStatus');
    }

    public function ticketCategory()
    {
        return $this->belongsTo('App\TicketCategory');
    }

    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }

    public function users()
    {
        return $this->belongsToMany('App\User','comments');
    }
}
