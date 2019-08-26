<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['first_name', 'last_name', 'imageuri' , 'country','team_id','jersey_no'];
    //
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function playerdetails()
    {
        return $this->hasOne(PlayerDetails::class);
    }
}
