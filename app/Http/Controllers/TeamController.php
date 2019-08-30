<?php

namespace App\Http\Controllers;

use App\Match;
use App\Point;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
    public function points()
    {
        $matches= Point::with('team')->paginate(5);
        // return ($matches);
        return view('points/table')->withMatches($matches);
        
        
    }//end of function
    /**
        * @SWG\Get(
        * path="/pointDetails",
        * description="Get point details for a specific team",
        * produces={"application/json"},
        * tags={""},
        * security={
        * {
        * "Bearer": {}
        * },
        * },
        * @SWG\Response(
        * response=200,
        * description="OK",
        * ),
        * @SWG\Response(
        * response=400,
        * description="Bad Request",
        * ),
        * @SWG\Response(
        * response=404,
        * description="Not Found"
        * )
        * )
    */
    public function pointDetails(Request $request)
    {
            $matches= Match::where('team_id',$request->team_id)->orwhere('against_team_id',$request->team_id)->with('team','against_team','winner_team')->get();
            $mdetails=array();
            $i=0;
            foreach($matches as $match)
            {
                $against_team=($match->team_id==$request->team_id?$match->against_team_id:$match->team_id);
                
                $mdetails[$against_team]['played_match']=(isset($mdetails[$against_team]['played_match'])?$mdetails[$against_team]['played_match']+1:1);
                $mdetails[$against_team]['team_name']=($match->team_id==$request->team_id?$match->against_team->name:$match->team->name);
                $mdetails[$against_team]['win']=(isset($mdetails[$against_team]['win'])?$mdetails[$against_team]['win']:0)+($match->winner_team->id==$request->team_id?1:0);
                $mdetails[$against_team]['draw']=(isset($mdetails[$against_team]['draw'])?$mdetails[$against_team]['draw']:0)+($match->winner_team->id==''?1:0);;
                $mdetails[$against_team]['lost']=(isset($mdetails[$against_team]['lost'])?$mdetails[$against_team]['lost']:0)+($match->winner_team->id!=$request->team_id?1:0);
                $mdetails[$against_team]['matches'][$i]['id']=$match->id;
                $mdetails[$against_team]['logo']=$match->against_team->logouri;
                $mdetails[$against_team]['matches'][$i]['winner_team_id']=$match->winner_team->id;
                $mdetails[$against_team]['matches'][$i]['winner_team_name']=$match->winner_team->name;
               
                $i++;
                
            }           
            if($request->ajax())
            {    
               return ($mdetails);
            }
            else{
                $team_name=Team::select('name')->where('id', $request->team_id)->get();
                return view('team/matchlists')->withMatches($mdetails)->withTeam($request->team_id)->withTeamnm($team_name[0]->name);
            }
    }//end of function
    public function result(Request $request)
    {
        if ($request->isMethod('post')) {

        //   print_r($request->all());
          
          
            $attribute=request()->validate([
                'team_id'=>['required','not_in:0','different:against_team_id'],
                'against_team_id'=>['required','not_in:0','different:team_id'],
                'total_tun_scored'=>['numeric'],
                'result'=>['required','not_in:0'],
            ]);
            $attribute['winner_team_id']=null;
            if($request->result==2)
            {   
                if($request->winner_team_id!=$request->team_id && $request->winner_team_id!=$request->against_team_id)
                {
                    return back()->with('winner','team is not in the match list');
                }
                else{
                    $attribute['winner_team_id']=$request->winner_team_id;
                }
            }    
            
            $attribute['total_tun_scored']=$request->total_tun_scored;
            $attribute['comments']=$request->comments;
            $attribute['description']=$request->description;
            /*** POINTS ARR STARTS */

            $point_attr[0]['team_id']=$request->team_id;
            $point_attr[1]['team_id']=$request->against_team_id;

            $point_attr[0]['win']=0;
            $point_attr[1]['win']=0;
            $point_attr[0]['loose']=0;
            $point_attr[1]['loose']=0;
            
            $point_attr[0]['draw']=0;
            $point_attr[1]['draw']=0;

            $point_attr[0]['point']=0;
            $point_attr[1]['point']=0;
            
            if($request->result==1)
            {
                $point_attr[0]['draw']=1;
                $point_attr[0]['point']=1;
                
                $point_attr[1]['draw']=1;
                $point_attr[1]['point']=1;
            }
            else
            {
                if($request->team_id==$request->winner_team_id)
                {
                    $point_attr[0]['win']=1;
                    $point_attr[0]['point']=3;

                    $point_attr[1]['loose']=1;
                    
                }
                else{

                    $point_attr[0]['loose']=1;

                    $point_attr[1]['win']=1;
                    $point_attr[1]['point']=3;
                }
            }
            
            /*** POINTS ARR ENDS */
            Match::create($attribute);
            foreach($point_attr as $p)
            {
                $point_team=Point::where('team_id',$p['team_id'])->latest()->first();
                $point_team->played+=1;
                $point_team->win+=$p['win'];
                $point_team->loose+=$p['loose'];
                $point_team->draw+=$p['draw'];
                $point_team->point+=$p['point'];
                $point_team->save();
            }
            return back()->with('success','points added');
            exit();
        }
        
        $teams=Team::teamDropDown();
        return view('points/create')->withTeams($teams);
    }//end of function
    
}
