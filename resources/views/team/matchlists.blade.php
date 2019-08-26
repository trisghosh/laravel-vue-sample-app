@extends('layouts.appinner')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Match Details') }}</div>
                <div class="table-card-header">
                        <div class="col-md-3 table-header">Team Name</div>
                        <div class="col-md-1 table-header">Played</div>
                        <div class="col-md-1 table-header">Win</div>
                        <div class="col-md-1 table-header">Draw</div>
                        <div class="col-md-1 table-header">Lost</div>
                        <div class="col-md-1 table-header">&nbsp;</div>
                </div>
                <div class="table-card-body">
                   <!-- lists goes here -->
                    @foreach($matches as $match)
                        <div class="col-md-12 table-tr">
                            <div class="col-md-3 table-td">
                            <img src="{{ asset('storage/teamlogos').'/'.$match['logo'] }}" class="team-logo">
                            {{$match['team_name']}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match['played_match']}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match['win']}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match['draw']}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match['lost']}}
                            </div>
                            <div class="col-md-1 table-td table-actions"> 
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

       
</div>
       

@endsection

