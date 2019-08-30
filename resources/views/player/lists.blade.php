@extends('layouts.appinner')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">
                    <div class="col-md-6 card-header-div">
                        {{ __('Player Lists') }}  @if ( $team ) 
                            of {{$players[0]->team->name}}
                        @endif
                    </div>
                    @auth
                        <div class="col-md-6 card-header-div action">
                            <a class="dropdown-item" href="/player/create">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add Player') }}
                            </a> 
                        </div>
                    @endauth                    
                </div>
                <div class="table-card-header">
                        <div class="col-md-4 table-header">Name</div>
                        <div class="col-md-2 table-header">Team</div>
                        <div class="col-md-2 table-header">State</div>
                        <div class="col-md-1 table-header">&nbsp;</div>
                </div>
               
                <div class="table-card-body">
                   <!-- lists goes here -->                   
                    @foreach($players as $player)
                        <div class="col-md-12 table-tr">
                            <div class="col-md-4 table-td">
                                    <img src="{{ asset('storage/playerimage').'/'.$player->imageuri }}" class="player-logo">
                                    {{ ucfirst( $player->first_name.' '.$player->last_name )}}

                            </div>
                            <div class="col-md-2 table-td">
                                {{$player->team->name}}
                            </div>
                            <div class="col-md-2 table-td">
                                {{$player->country}}
                            </div>
                            <div class="col-md-1 table-td"> <a href="" @click.prevent="showPlayerDetails({ player_id: '{{$player->id}}' })"><i class="fa fa-eye"></i></a></div>
                            
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="crickinfo-paginate">{{ $players->links() }}</div>    
    <modal name="player" height="auto">
        <ajaxplayerdata :id="showPlayerId"></ajaxplayerdata>
    </modal>
</div>
       

@endsection

