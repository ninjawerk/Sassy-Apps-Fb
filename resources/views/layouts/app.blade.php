<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('facebook_meta')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sassy Apps') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/custom.css') }}" rel="stylesheet">
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
</head>
<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=415969778585936';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<nav class="navbar navbar-default" style="background-color: #616161;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" style="color: #fff;" href="#">Sassy Apps</a>
        </div>

    </div>
</nav>
<div id="app ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
            <div class="col-md-12 ">
                <div class="row ">
                    @foreach ($latestApps as $app)
                        <div class="col-md-3 col-lg-offset-1 col-sm-5 col-xs-12  horizontal-align">
                            <div class="horizontal-align text-center appblock">
                                <img width="80" height="80" src="{{$app->icon_url}}">
                                <h2>{{$app->name}}</h2>
                                <h5>{{$app->description}}</h5>
                                <a class="btn btn-round btn-primary" style="margin-top: 20px"
                                   href="/splash?appid={{$app->id}}">
                                    START
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
