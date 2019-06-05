<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function guests()
    {
        return $this->belongsToMany('App\Guest');
    }
}
