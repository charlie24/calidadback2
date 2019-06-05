<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot',
    ];

    public function invitations()
    {
        return $this->belongsToMany('App\Invitation');
    }
}
