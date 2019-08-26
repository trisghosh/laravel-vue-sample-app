<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function against_team()
    {
        return $this->belongsTo(Team::class,'against_team_id');
    }
    public function winner_team()
    {
        return $this->belongsTo(Team::class,'winner_team_id');
    }
}
