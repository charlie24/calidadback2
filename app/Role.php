<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
