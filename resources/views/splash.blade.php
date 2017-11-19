@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="vertical-align app-panel"  >


                <div class="horizontal-align text-center">
	                <img width="150" height="150" src="{{$app->icon_url}}">
                    <h2>{{$app->name}}</h2>
                    <h5>{{$app->description}}</h5>
	                <a class="btn btn-round btn-primary" style="margin-top: 20px" href="/fbapp?appid={{$app->id}}">
		                CONTINUE
	                </a>
                </div>
            </div>
        </div>
    </div>

@endsection
