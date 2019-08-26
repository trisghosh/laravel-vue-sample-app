<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name','logouri' , 'club_state'];
    //
    public static function teamDropDown()
    {
        $teams =Team::all('id','name');
        return $teams;
    }    
    public function player()
    {
        return $this->hasMany(Player::class);
    }
    public function point()
    {
        return $this->hasMany(Point::class);
    }
    public function match()
    {
        return $this->hasMany(Match::class);
    }
}
