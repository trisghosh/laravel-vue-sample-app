<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //
    protected $fillable = ['team_id', 'against_team_id', 'winner_team_id' , 'total_tun_scored','result','comments','description'];
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
