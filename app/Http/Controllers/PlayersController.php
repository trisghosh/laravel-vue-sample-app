<?php

namespace App\Http\Controllers;

use App\Player;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $players =Player::with(['team','playerdetails'])->paginate(1);
        // dd($players);
        return view('player/lists')->withPlayers($players)->withTeam(0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teams=Team::teamDropDown();
        return view('player/create')->withTeams($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $attribute=request()->validate([
            'first_name'=>['required','min:5','max:255'],
            'last_name'=>['required','min:5','max:255'],
            'imageuri'=>['required','mimes:jpeg,bmp,png'],
            'country'=>['required','min:5','max:255'],
            'team_id'=>'required|not_in:0',
            'jersey_no'=>''
        ]);
        if (Input::hasFile('imageuri'))
        {
            $fileName=Input::file('imageuri');
            $attribute['imageuri']=$imageName=str_replace(' ','_',$request->first_name).'_'.str_replace(' ','_',$request->last_name).time().'.'.$fileName->getClientOriginalExtension(); 
            $destinationPath='playerimage';
            $request->imageuri->storeAs($destinationPath, $imageName,'public');
        }
        Player::create($attribute);
        return redirect('/players');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }
    public function playerdetails(Request $request)
    {
        if($request->ajax()){
            
            $player =Player::with(['team','playerdetails'])->find( $request->id);
            return $player;
            die();
        }
        return response(['status' => false,'code' =>403,],403);
    }
    public function teamLists(Request $request)
    {
        $players =Player::with(['team','playerdetails'])->where('team_id',$request->team_id)->paginate(1);
        if($players->count())
        {
            return view('player/lists')->withPlayers($players)->withTeam(1);
        }
        else{
            return view('nodata')->withMessage('No Players Found');
        }
        
    }
}
