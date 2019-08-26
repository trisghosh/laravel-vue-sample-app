<?php

namespace App\Http\Controllers;

use App\Match;
use App\Point;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teams =Team::paginate(2);
        return view('team/lists')->withTeams($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('team/create');
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
            'name'=>['required','min:5','max:255'],
            'logouri'=>['required','mimes:jpeg,bmp,png'],
            'club_state'=>['required','min:5','max:255']
        ]);
        if (Input::hasFile('logouri'))
        {
            $fileName=Input::file('logouri');
            $attribute['logouri']=$imageName=str_replace(' ','_',$request->name).time().'.'.$fileName->getClientOriginalExtension(); 
            $destinationPath='teamlogos';
            $request->logouri->storeAs($destinationPath, $imageName,'public');
        }
        Team::create($attribute);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
    public function teamdetails(Request $request)
    {
        if($request->ajax())
        {            
            $team =Team::with(['player.playerdetails','point'])->find( $request->id);
            return $team;
        }
        return response(['status' => false,'code' =>403,],403);
    }//
    public function pointDetails(Request $request)
    {
        // if($request->ajax())
        // {
            // $team =Team::with('match')->find($request->team_id);
            $matches= Match::where('team_id',$request->team_id)->orwhere('against_team_id',$request->team_id)->with('team','against_team','winner_team')->get();
            $mdetails=array();
            $i=0;
            foreach($matches as $match)
            {
                $against_team=($match->team_id==$request->team_id?$match->against_team_id:$match->team_id);
                $mdetails[$against_team]['played_match']=(isset($mdetails[$against_team]['played_match'])?$mdetails[$against_team]['played_match']+1:1);
                $mdetails[$against_team]['team_name']=($match->team_id==$request->team_id?$match->against_team->name:$match->team->name);
                $mdetails[$against_team]['matches'][$i]['id']=$match->id;
                $mdetails[$against_team]['matches'][$i]['winner_team_id']=$match->winner_team->id;
                $mdetails[$against_team]['matches'][$i]['winner_team_name']=$match->winner_team->name;
               
                $i++;
                
            }

            print_r($mdetails);


            // return view('team/matchlists')->withMatches($matches)->withTeam($request->team_id);
            // return $matches;
            
        // }
        // return response(['status' => false,'code' =>403,],403);
    }
    
}
