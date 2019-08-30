@extends('layouts.appinner')
@section('content')
<div class="container">
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Match Point') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('result') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Team 1') }}</label>

                            <div class="col-md-6">
                                <select name="team_id" id="team_id" @change="onChange($event)" class="form-control @error('team_id') is-invalid @enderror"  value="{{ old('team_id') }}" required  autocomplete="team_id" autofocus>
                                    <option value="0">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                                @error('team_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Team 2') }}</label>

                            <div class="col-md-6">
                                <select name="against_team_id" id="against_team_id" class="form-control @error('against_team_id') is-invalid @enderror"  value="{{ old('against_team_id') }}" required  autocomplete="against_team_id" autofocus>
                                    <option value="0">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                                @error('against_team_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Result') }}</label>

                            <div class="col-md-6">
                               <select name="result" id="result" @change="showHide($event)" class="form-control @error('result') is-invalid @enderror">
                                    <option value="0">Select Result</option>
                                    <option value="1">Drawn</option>
                                    <option value="2">Win/Loss</option>
                               </select>
                                @error('result')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row"  v-if="{{Session::get('winner')?'':'seen'}}" id="hide">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Winner Team') }}</label>

                            <div class="col-md-6">
                                <select name="winner_team_id" id="winner_team_id" class="form-control @error('winner_team_id') is-invalid @enderror"  value="{{ old('winner_team_id') }}" required  autocomplete="winner_team_id" autofocus>
                                    <option value="0">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                                @if ($message = Session::get('winner'))
                                    <span class="invalid-feedback" role="alert" style="display:block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Total Run Scored') }}</label>

                            <div class="col-md-6">
                                <textarea name="total_tun_scored" id="total_tun_scored" cols="30" rows="2"  class="form-control @error('total_tun_scored') is-invalid @enderror"  value="{{ old('total_tun_scored') }}" required  autocomplete="total_tun_scored" autofocus></textarea>
                                @error('total_tun_scored')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Result Text') }}</label>

                            <div class="col-md-6">
                                <textarea name="result_text" id="result_text" cols="30" rows="2"  class="form-control @error('result_text') is-invalid @enderror"  value="{{ old('result_text') }}" required  autocomplete="result_text" autofocus></textarea>
                                @error('result_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>

                            <div class="col-md-6">
                                <textarea name="comments" id="comments" cols="30" rows="2"  class="form-control @error('comments') is-invalid @enderror"  value="{{ old('comments') }}" required  autocomplete="comments" autofocus></textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descriptions') }}</label>

                            <div class="col-md-6">
                                <textarea name="description" id="description" cols="30" rows="2"  class="form-control @error('description') is-invalid @enderror"  value="{{ old('description') }}" required  autocomplete="description" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

