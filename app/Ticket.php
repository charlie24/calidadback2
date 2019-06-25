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

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function commenters()
    {
        return $this->hasManyThrough('App\User', 'App\Comment');
    }

    public function scopeSearch($query, $term) {
        if (!$term) return $query;

        return $query->when(!$this->isJoined($query, 'residents'), function($query) {
            return $query->join('residents', 'residents.id', '=', 'tickets.resident_id');
        })->when(!$this->isJoined($query, 'users'), function($query) {
            return $query->join('users', 'users.id', '=', 'residents.user_id');
        })
        ->whereRaw("LOWER(tickets.message) LIKE ? ", '%'.strtolower(trim($term)).'%')
        ->orWhereRaw("LOWER(users.name) LIKE ? ", '%'.strtolower(trim($term)).'%');
    }

    public static function isJoined($query, $table)
    {
        $joins = $query->getQuery()->joins;
        if($joins == null) {
            return false;
        }
        foreach ($joins as $join) {
            if ($join->table == $table) {
                return true;
            }
        }
        return false;
    }
}
