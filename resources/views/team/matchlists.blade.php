@extends('layouts.appinner')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Match Details') }}</div>
                <div class="table-card-header">
                        <div class="col-md-2 table-header">Team Name</div>
                        <div class="col-md-4 table-header">State</div>
                        <div class="col-md-1 table-header">&nbsp;</div>
                </div>
                <div class="table-card-body">
                   <!-- lists goes here -->
                    @foreach($matches as $match)
                        <div class="col-md-12 table-tr">
                            <div class="col-md-2 table-td">
                            {{ $match->team_id===$team?$match->against_team->name:$match->team->name}}
                            </div>
                            <div class="col-md-4 table-td">
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

