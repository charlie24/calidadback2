<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function ticketStatus()
    {
        return $this->belongsTo('App\TicketStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
