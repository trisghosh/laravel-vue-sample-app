@extends('layouts.appinner')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Points Table ') }}</div>
                <div class="table-card-header">
                        <div class="col-md-3 table-header">Team Name</div>
                        <div class="col-md-1 table-header">Played</div>
                        <div class="col-md-1 table-header">Win</div>
                        <div class="col-md-1 table-header">Draw</div>
                        <div class="col-md-1 table-header">Lost</div>
                        <div class="col-md-1 table-header">Point</div>
                        <div class="col-md-1 table-header">&nbsp;</div>
                </div>
                <div class="table-card-body">
                   <!-- lists goes here -->
                    @foreach($matches as $match)
                        <div class="col-md-12 table-tr">
                            <div class="col-md-3 table-td">
                            <a href="points/{{$match->team->id}}">
                                <img src="{{ asset('storage/teamlogos').'/'.$match->team->logouri }}" class="team-logo">
                                {{$match->team->name}}
                            </a>
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match->played}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match->win}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match->draw}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match->loose}}
                            </div>
                            <div class="col-md-1 table-td">
                            {{$match->point}}
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

