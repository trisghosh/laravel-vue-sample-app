@extends('layouts.appinner')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Team Lists') }}</div>
                <div class="table-card-header">
                        <div class="col-md-6 table-header">Team Name</div>
                        <div class="col-md-4 table-header">State</div>
                        <div class="col-md-1 table-header">&nbsp;</div>
                </div>
                <div class="table-card-body">
                   <!-- lists goes here -->
                    @foreach($teams as $team)
                        <div class="col-md-12 table-tr">
                            <div class="col-md-6 table-td">
                                    <img src="{{ asset('storage/teamlogos').'/'.$team->logouri }}" class="team-logo">
                                    {{$team->name}}
                            </div>
                            <div class="col-md-4 table-td">
                                {{$team->club_state}}
                            </div>
                            <div class="col-md-1 table-td table-actions"> 
                                <a href="" @click.prevent="showTeamDetails({ team_id: '{{$team->id}}' })"><i class="fa fa-eye" alt="team details in popup" title="team details in popup"></i></a>
                                <a href="" @click.prevent="showPointsTable({ team_id: '{{$team->id}}' })"><i class="fa fa-table" alt="points table" title="points table"></i></a>
                                <a href="{{ route('players').'/'.$team->id }}" ><i class="fa fa-users" alt="Player lists" title="Player lists"></i></a>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="crickinfo-paginate">{{ $teams->links() }}</div>
        <modal name="teams">
            <ajaxteamdata :id="showTeamId"></ajaxteamdata>           
        </modal>
        <modal name="points">
            <ajaxpointsdata :id="showTeamId"></ajaxpointsdata>
        </modal>

       
</div>
       

@endsection

